<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\DetalleVenta;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function checkout(){
        $carrito = session()->get('carrito', []);

        return view('pages.compraCliente', compact('carrito'));
    }

    public function guardarCarrito(Request $request){
        session([
            'carrito' => $request->carrito
        ]);

        return response()->json([
            'success' =>true
        ]);
    }

    public function finalizarCompra(Request $request){
        $carrito = session()->get('carrito', []);

        //si el carrito está vacío
        if(empty($carrito)){
            return back()->with('error', 'El carrito está vacío');
        }

        DB::beginTransaction();

        try{
            //crear venta
            $venta = Venta::create([
                'usuario_id' => auth()->id(),
                'total' => 0,
                'estado' => 'pendiente'
            ]);

            $total = 0;

            foreach($carrito as $item){
                $subtotal = $item['precio'] * $item['cantidad'];

                //guardar detalle
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $item['id'],
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['precio'],
                    'subtotal' => $subtotal
                ]);

                //buscar producto para descontar del stock
                $producto = Producto::find($item['id']);
                //descontar del stock
                if($producto->stock < $item['cantidad']){
                    throw new \Exception("Stock insuficiente para {$producto->nombre}");
                }
                $producto->stock -= $item['cantidad'];
                $producto->save();

                $total += $subtotal;
            }

            //actualizar total final
            $venta->total = $total;
            $venta->save();

            DB::commit();

            //vaciar carrito
            session()->forget('carrito');

            return redirect('/perfil')
                ->with('success', 'Compra realizada correctamente');
        }catch(\Exception $e){
            DB::rollBack();

            return back()->with('error', 'Error al procesar la compra');
        }
    }
}
