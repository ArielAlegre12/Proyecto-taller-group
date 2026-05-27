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
        $request->validate([
            'metodo_pago' => 'required',
            'metodo_entrega' => 'required'
        ]);

        if($request->metodo_pago === 'tarjeta'){
            $request->validate([
                'numero_tarjeta' => 'required|min:16|max:16',
                'titular' => 'required|string|max:255',
                'vencimiento' => 'required',
                'cvv' => 'required|min:3|max:3'
            ]);
        }

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
                'estado' => 'pendiente',
                'metodo_pago' => $request->metodo_pago,
                'metodo_entrega' => $request->metodo_entrega
            ]);

            $total = 0;

            foreach($carrito as $item){
                $subtotal = $item['precio'] * $item['cantidad'];

                //guardar detalle
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $item['id'],
                    'nombre_producto' =>$item['nombre'],
                    'imagen_producto' => $item['imagen'],
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
                if($producto->stock <=0){
                    $producto->stock = 0;
                    $producto->activo = false;
                }
                $producto->save();

                $total += $subtotal;
            }

            //calcular costo de envío
            $costoEnvio = 0;

            if($request->metodo_entrega == 'domicilio'){
                $costoEnvio = 2500;
            }
            if($request->metodo_entrega == 'express'){
                $costoEnvio = 5000;
            }

            //total final
            $totalFinal = $total + $costoEnvio;

            //actualizar venta
            $venta->total = $totalFinal;
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
