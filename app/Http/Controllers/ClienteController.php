<?php

namespace App\Http\Controllers;

use App\Models\CarritoItem;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\DetalleVenta;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    private function obtenerCarritoUsuario()
    {
        $user = auth()->user();
        return $user->carrito()->firstOrCreate([]);
    }

    public function checkout()
    {
        if(!auth()->check()){
            return redirect('/login')
                ->with('error', 'Debes iniciar sesión para continuar');
        }

        $carrito = $this->obtenerCarritoUsuario()
            ->items()
            ->with('producto')
            ->get();
        
        return view('pages.compraCliente', compact('carrito'));
    }

    public function obtenerCarrito()
    {
        //invitado
        if (!auth()->check()) {
            $carrito = session()->get('carrito', []);
            $items = [];

            foreach ($carrito as $item) {
                $producto = Producto::find($item['producto_id']);
                if ($producto) {
                    $items[] = [
                        'cantidad' => $item['cantidad'],
                        'producto' => $producto
                    ];
                }
            }
            return response()->json($items);
        }
        //logeado
        $items = $this->obtenerCarritoUsuario()
            ->items()
            ->with('producto')
            ->get();

        return response()->json($items);
    }

    public function agregarProducto(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        //para invitados
        if (!auth()->check()) {
            $carrito = session()->get('carrito', []);

            $existe = false;

            foreach ($carrito as &$item) {
                if ($item['producto_id'] == $request->producto_id) {
                    $item['cantidad'] += $request->cantidad;
                    $existe = true;
                    break;
                }
            }

            if (!$existe) {
                $carrito[] = [
                    'producto_id' => $request->producto_id,
                    'cantidad' => $request->cantidad
                ];
            }

            session(['carrito' => $carrito]);
            return response()->json([
                'success' => true
            ]);
        }

        $carrito = $this->obtenerCarritoUsuario();

        $producto = Producto::findOrFail($request->producto_id);

        $item = $carrito->items()
            ->where('producto_id', $request->producto_id)
            ->first();

        if ($item) {
            $nuevaCantidad = $item->cantidad + $request->cantidad;

            if ($nuevaCantidad > $producto->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stock insuficiente'
                ], 400);
            }

            $item->cantidad = $nuevaCantidad;
            $item->save();
        } else {
            if ($request->cantidad > $producto->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stock insuficiente'
                ], 400);
            }

            CarritoItem::create([
                'carrito_id' => $carrito->id,
                'producto_id' => $request->producto_id,
                'cantidad' => $request->cantidad
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function eliminarProducto(Request $request)
    {
        $request->validate([
            'producto_id' => 'required'
        ]);

        if (!auth()->check()) {
            $carrito = session()->get('carrito', []);
            $carrito = array_filter($carrito, function ($item) use ($request) {
                return $item['producto_id'] != $request->producto_id;
            });
            session(['carrito' => array_values($carrito)]);

            return response()->json([
                'success' => true
            ]);
        }

        $this->obtenerCarritoUsuario()
            ->items()
            ->where('producto_id', $request->producto_id)
            ->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function cambiarCantidad(Request $request)
    {
        $request->validate([
            'producto_id' => 'required',
            'cantidad' => 'required|integer|min:1'
        ]);

        if (!auth()->check()) {
            $carrito = session()->get('carrito', []);
            foreach ($carrito as &$item) {
                if ($item['producto_id'] == $request->producto_id) {
                    $item['cantidad'] = $request->cantidad;
                    break;
                }
            }
            session(['carrito' => $carrito]);

            return response()->json([
                'success' => true
            ]);
        }

        $producto = Producto::findOrFail($request->producto_id);

        $item = $this->obtenerCarritoUsuario()
            ->items()
            ->where('producto_id', $request->producto_id)
            ->first();

        if ($item) {
            if ($request->cantidad > $producto->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stock insuficiente'
                ], 400);
            }
            $item->cantidad = $request->cantidad;
            $item->save();
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function vaciarCarrito()
    {
        if (!auth()->check()) {
            session()->forget('carrito');

            return response()->json([
                'success' => true
            ]);
        }

        $this->obtenerCarritoUsuario()
            ->items()
            ->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function finalizarCompra(Request $request)
    {
        $request->validate([
            'metodo_pago' => 'required',
            'metodo_entrega' => 'required'
        ]);

        if ($request->metodo_pago === 'tarjeta') {
            $request->validate([
                'numero_tarjeta' => 'required|min:16|max:16',
                'titular' => 'required|string|max:255',
                'vencimiento' => 'required',
                'cvv' => 'required|min:3|max:3'
            ]);
        }

        $carrito = $this->obtenerCarritoUsuario()
            ->items()
            ->with('producto')
            ->get();

        //si el carrito está vacío
        if ($carrito->isEmpty()) {
            return back()->with('error', 'El carrito está vacío');
        }

        DB::beginTransaction();

        try {
            //crear venta
            $venta = Venta::create([
                'usuario_id' => auth()->id(),
                'total' => 0,
                'estado' => 'pendiente',
                'metodo_pago' => $request->metodo_pago,
                'metodo_entrega' => $request->metodo_entrega
            ]);

            $total = 0;

            foreach ($carrito as $item) {
                $subtotal = $item->producto->precio * $item->cantidad;

                //guardar detalle
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $item->producto->id,
                    'nombre_producto' => $item->producto->nombre,
                    'imagen_producto' => $item->producto->imagen,
                    'cantidad' => $item->cantidad,
                    'precio' => $item->producto->precio,
                    'subtotal' => $subtotal
                ]);

                //buscar producto para descontar del stock
                $producto = $item->producto;
                //descontar del stock
                if ($producto->stock < $item->cantidad) {
                    throw new \Exception("Stock insuficiente para {$producto->nombre}");
                }
                $producto->stock -= $item->cantidad;
                if ($producto->stock <= 0) {
                    $producto->stock = 0;
                    $producto->activo = false;
                }
                $producto->save();

                $total += $subtotal;
            }

            //calcular costo de envío
            $costoEnvio = 0;

            if ($request->metodo_entrega == 'domicilio') {
                $costoEnvio = 2500;
            }
            if ($request->metodo_entrega == 'express') {
                $costoEnvio = 5000;
            }

            //total final
            $totalFinal = $total + $costoEnvio;

            //actualizar venta
            $venta->total = $totalFinal;
            $venta->save();

            DB::commit();

            $this->obtenerCarritoUsuario()
                ->items()
                ->delete();

            return redirect('/perfil')
                ->with('success', 'Compra realizada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }
}
