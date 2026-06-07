<?php

namespace App\Http\Controllers;

use App\Mail\PagoConfirmadoMail;
use App\Models\Domestico;
use App\Models\Produccion;
use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Venta;
use App\Models\Consulta;
use App\Mail\ConsultaEliminadaMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Mail\TurnoReprogramadoMail;
use App\Mail\TurnoConfirmadoMail;
use App\Mail\TurnoCanceladoMail;
use App\Mail\PedidoEnviadoMail;
use App\Mail\PedidoEntregadoMail;

class AdminController extends Controller
{
    public function dashboard(){
        $totalProductos = Producto::count();
        $totalUsuarios = Usuario::count();
        $totalConsultas = Consulta::count();

        //sumamos los turnos domesticos/producción
        $totalTurnos = Domestico::count() + Produccion::count();

        //productos con stock bajo
        $stockBajo = Producto::where('stock', '<=', 5)->count();

        //actividad reciente
        $ultimosProductos = Producto::latest()->take(3)->get();
        $ultimosUsuarios = Usuario::latest()->take(3)->get();
        $ultimosTurnosDomesticos = Domestico::latest()->take(3)->get();
        $ultimosTurnosProduccion = Produccion::latest()->take(3)->get();
        $ultimasConsultas = Consulta::latest()->take(3)->get();


        return view('backend.admin.dashboard', compact(
            'totalProductos',
            'totalUsuarios',
            'totalTurnos',
            'stockBajo',
            'totalConsultas',
            'ultimosProductos',
            'ultimosUsuarios',
            'ultimosTurnosDomesticos',
            'ultimosTurnosProduccion',
            'ultimasConsultas'
        ));
    }

    public function usuarios(){
        $usuarios = Usuario::with('rol')->get();
        return view('backend.admin.usuarios.index', compact('usuarios'));
    }

    public function showUsuario(Usuario $usuario){
        return view('backend.admin.usuarios.show', compact('usuario'));
    }

    public function destroyUsuario(Usuario $usuario){
        if($usuario->id == auth()->id()){
            return back()->with('error', 'No puedes eliminar tu propio usuario');
        }
        $usuario->delete();
        return redirect('/backend/admin/usuarios')
            ->with('success', 'Usuario eliminado correctamente');
    }

    public function cambiarRol(Usuario $usuario){
        //evitar cambiar mi propio rol
        if($usuario->id == auth()->id()){
            return back()->with('error', 'No puedes cambiar tu propio rol');
        }

        //si es admin pasa a cliente
        if($usuario->rol_id == 1){
            $usuario->rol_id = 2;
        }else{
            //si es cliente pasa a admin
            $usuario->rol_id = 1;
        }

        $usuario->save();

        return back()->with('success', 'Rol actualizado correctamente');
    }

    public function turnos(){

        $turnosDomesticos = Domestico::query();
        $turnosProduccion = Produccion::query();

        if(request('buscar')){
            $turnosDomesticos->where('nombreDueño', '%' . request('buscar') . '%');
            $turnosProduccion->where('nombreEstablo', 'like', '%' . request('buscar') . '%');
        }

        if(request('estado')){
            $turnosDomesticos->where('estado', request('estado'));
            $turnosProduccion->where('estado',request('estado'));
        }

        if(request('desde')){
            $turnosDomesticos->whereDate('fechaYHora', '>=', request('desde'));
            $turnosProduccion->whereDate('fehaYHora', '>=', request('desde'));
        }

        if(request('hasta')){
            $turnosDomesticos->whereDate('fechaYHora', '<=', request('hasta'));
            $turnosProduccion->whereDate('fechaYHora', '<=', request('hasta'));
        }

        if(request('tipo') == 'domestico'){
            $turnosProduccion->whereRaw('1 = 0');
        }
        
        if(request('tipo') == 'produccion'){
            $turnosDomesticos->whereRaw('1 = 0');
        }

        $turnosDomesticos = $turnosDomesticos->latest()->get();
        $turnosProduccion = $turnosProduccion->latest()->get();

        return view('backend.admin.turnos.index', compact(
            'turnosDomesticos',
            'turnosProduccion'
        ));
    }

    public function confirmarDomestico(Domestico $domestico){
        $domestico->estado = 'confirmado';
        $domestico->save();

        Mail::to($domestico->usuario->email)->send(new TurnoConfirmadoMail($domestico));

        return back()->with('success', 'Turno confirmado');
    }
    
    public function cancelarDomestico(Request $request, Domestico $domestico){
        $domestico->estado = 'cancelado';
        $domestico->save();

        $usuario = Usuario::find($domestico->usuario_id);

        Mail::to($usuario->email)->send(new TurnoCanceladoMail($domestico, $request->motivo));

        return back()->with('success', 'Turno cancelado');
    }

    public function reprogramarDomestico(Request $request, Domestico $domestico){
        $request->validate([
            'fechaYHora' => 'required|date'
        ]);

        $domestico->fechaYHora = $request->fechaYHora;

        //se coloca en reprogramado
        $domestico->fecha_original = $domestico->fechaYHora;
        $domestico->fechaYHora = $request->fechaYHora;
        $domestico->estado = 'reprogramado';

        $domestico->save();

        Mail::to($domestico->usuario->email)->send(new TurnoReprogramadoMail($domestico));

        return back()->with('success', 'Turno repogramado');
    }

    public function confirmarProduccion(Produccion $produccion){
        $produccion->estado = 'confirmado';
        $produccion->save();

        Mail::to($produccion->usuario->email)->send(new TurnoConfirmadoMail($produccion));

        return back()->with('success', 'Turno confirmado');
    }

    public function cancelarProduccion(Request $request, Produccion $produccion){
        $produccion->estado = 'cancelado';
        $produccion->save();
        

        Mail::to($produccion->usuario->email)->send(new TurnoCanceladoMail($produccion, $request->motivo));

        return back()->with('success', 'Turno cancelado');
    }

    public function reprogramarProduccion(Request $request, Produccion $produccion){
        $request->validate([
            'fechaYHora' => 'required|date'
        ]);

        $produccion->fecha_original = $produccion->fechaYHora;
        $produccion->fechaYHora = $request->fechaYHora;
        $produccion->estado = 'reprogramado';

        $produccion->save();

        Mail::to($produccion->usuario->email)->send(new TurnoReprogramadoMail($produccion));

        return back()->with('success', 'Turno reprogramado');
    }

    public function ventas(Request $request){
        $request->validate([
            'desde' => 'nullable|date|before_or_equal:today',
            'hasta' => 'nullable|date|after_or_equal:desde|before_or_equal:today'
        ], [
            'desde.before_or_equal' => 'La fecha desde no puede ser mayor a hoy',
            'hasta.before_or_equal' => 'La fecha hasta no puede ser mayor a hoy',
            'hasta.after_or_equal' => 'La fecha final no puede ser menor a la inicial'
        ]);

        $ventas = Venta::with([
            'usuario',
            'detalles',
            'detalles.producto'
        ]);


        //buscar clientes
        if($request->cliente){
        $ventas->whereHas('usuario', function($query) use ($request){
            $query->where('nombre', 'like', '%' . $request->cliente . '%');
        });
        }

        //filtrar estado
        if($request->estado){
            $ventas->where('estado', $request->estado);
        }

        //filtrar desde
        if($request->desde){
            $ventas->whereDate('created_at', '>=', $request->desde);
        }

        //filtrar hasta 
        if($request->hasta){
            $ventas->whereDate('created_at', '<=', $request->hasta);
        }

        //metodo de entrega
        if($request->entrega){
            $ventas->where('metodo_entrega', $request->entrega);
        }

        //ordenar y obtener resultados
        $ventas = $ventas->latest()->get();

        //ventas validas para el agrupado
        $ventasValidas = $ventas->filter(function($venta){
            return in_array($venta->estado, [
                'pagado',
                'enviado',
                'entregado'
            ]);
        });

        //resumen-estadisticas

        //total vendido
        $totalVendido = $ventas
            ->whereIn('estado', ['pagado', 'enviado', 'entregado'])
            ->sum('total');

        //cantidad pedidos
        $totalPedidos = $ventasValidas->count();

        //ticket promedio
        $ticketPromedio = $totalPedidos > 0
            ? $totalVendido / $totalPedidos
            : 0;

        //productos vendidos
        $totalProductosVendidos = $ventasValidas
            ->flatMap->detalles
            ->sum('cantidad');

        //método de entrega más usado
        $metodoEntregaTop = $ventasValidas
            ->groupBy('metodo_entrega')
            ->map(fn($ventas) => $ventas->count())
            ->sortDesc()
            ->keys()
            ->first();

        //cliente que más tarasca gastó
        $clienteTop = $ventasValidas
            ->groupBy('usuario.nombre')
            ->map(fn($ventas) => $ventas->sum('total'))
            ->sortDesc()
            ->take(5);

        //estado más frecuente
        $estadoTop = $ventas
            ->groupBy('estado')
            ->map(fn($ventas) => $ventas->count())
            ->sortDesc()
            ->keys()
            ->first();
        
        

        //productos vendidos según el filtro
        $productosAgrupados = $ventasValidas
            ->flatMap->detalles
            ->groupBy('producto_id')
            ->map(function($detalles){
                $producto = $detalles->first()->producto;

                if(!$producto){
                    return null;
                }

                return (object)[
                    'nombre' => $producto->nombre,
                    'imagen' => $producto->imagen,
                    'total_vendidos' => $detalles->sum('cantidad')
                ];
            })
            ->filter()
            ->sortByDesc('total_vendidos');

        $cantidadProductos = $productosAgrupados->count();

        //top productos
        $productosMasVendidos = $productosAgrupados
            ->take(5);

        //menos vendido
        $productoMenosVendido = $productosAgrupados
            ->last();

        return view('backend.admin.ventas.index', compact(
            'ventas',
            'productosMasVendidos',
            'productoMenosVendido',
            'cantidadProductos',

            'totalVendido',
            'totalPedidos',
            'ticketPromedio',
            'totalProductosVendidos',
            'metodoEntregaTop',
            'clienteTop',
            'estadoTop'
        ));
    }

    public function marcarPagado(Venta $venta){
        $venta->estado = 'pagado';
        $venta->save();

        Mail::to($venta->usuario->email)->send(new PagoConfirmadoMail($venta));

        return back()->with('success', 'Pago confirmado y correo enviado');
    }

    public function marcarEnviado(Venta $venta){
        $venta->estado = 'enviado';
        $venta->save();

        Mail::to($venta->usuario->email)->send(new PedidoEnviadoMail($venta));

        return back()->with('success', 'Pedido enviado y correo notificado');
    }

    public function marcarEntregado(Venta $venta){
        $venta->estado = 'entregado';
        $venta->save();

        Mail::to($venta->usuario->email)->send(new PedidoEntregadoMail($venta));

        return back()->with('success', 'Pedido entregado y correo notificado');
    }

    public function consultas(){
        
        $consultas = Consulta::query();

        if(request('buscar')){
            $consultas->where('nombre', 'like', '%' . request('buscar') . '%');
        }

        if(request('animal')){
            $consultas->where('tipo_animal', 'like', '%' . request('animal') . '%');
        }

        if(request('estado')){
            $consultas->where('estado', request('estado'));
        }

        if(request('desde')){
            $consultas->whereDate('fecha_hora', '>=', request('desde'));
        }

        if(request('hasta')){
            $consultas->whereDate('fecha_hora', '<=', request('hasta'));
        }
        $consultas = $consultas->latest()->get();

        return view('backend.admin.consultas.index', compact('consultas'));
    }

    public function showConsulta(Consulta $consulta){
        return view('backend.admin.consultas.show', compact('consulta'));
    }

    public function confirmarConsulta(Consulta $consulta){
        $consulta->estado = 'confirmada';
        $consulta->save();

        return redirect('/backend/admin/consultas')
                ->with('success', 'Consulta confirmada');
    }

    public function destroyConsulta(Request $request, Consulta $consulta){
        Mail::to($consulta->email)->send(new ConsultaEliminadaMail($consulta, $request->motivo));
    
        $consulta->delete();

        return redirect('/backend/admin/consultas')
            ->with('success', 'Consulta eliminada');
    }

    public function descargarResumenPDF(Request $request){
        $ventas = Venta::with([
            'usuario',
            'detalles',
            'detalles.producto'
        ]);

        //buscar clientes
        if($request->cliente){
            $ventas->whereHas('usuario', function($query) use ($request){
                $query->where('nombre', 'like', '%' . $request->cliente . '%');
            });
        }

        //filtrar estado
        if($request->estado){
            $ventas->where('estado', $request->estado);
        }

        //filtrar desde
        if($request->desde){
            $ventas->whereDate('created_at', '>=', $request->desde);
        }

        //filtrar hasta 
        if($request->hasta){
            $ventas->whereDate('created_at', '<=', $request->hasta);
        }

        //metodo de entrega
        if($request->entrega){
            $ventas->where('metodo_entrega', $request->entrega);
        }

        //ordenar y obtener resultados
        $ventas = $ventas->latest()->get();

        //ventas validas para el agrupado
        $ventasValidas = $ventas->filter(function($venta){
            return in_array($venta->estado, [
                'pagado',
                'enviado',
                'entregado'
            ]);
        });

        //resumen-estadisticas

        //total vendido
        $totalVendido = $ventas
            ->whereIn('estado', ['pagado', 'enviado', 'entregado'])
            ->sum('total');

        //cantidad pedidos
        $totalPedidos = $ventasValidas->count();

        //ticket promedio
        $ticketPromedio = $totalPedidos > 0
            ? $totalVendido / $totalPedidos
            : 0;

        //productos vendidos
        $totalProductosVendidos = $ventasValidas
            ->flatMap->detalles
            ->sum('cantidad');

        //método de entrega más usado
        $metodoEntregaTop = $ventasValidas
            ->groupBy('metodo_entrega')
            ->map(fn($ventas) => $ventas->count())
            ->sortDesc()
            ->keys()
            ->first();

        //cliente que más tarasca gastó
        $clienteTop = $ventasValidas
            ->groupBy('usuario.nombre')
            ->map(fn($ventas) => $ventas->sum('total'))
            ->sortDesc()
            ->take(5);

        //estado más frecuente
        $estadoTop = $ventas
            ->groupBy('estado')
            ->map(fn($ventas) => $ventas->count())
            ->sortDesc()
            ->keys()
            ->first();

        //productos vendidos según el filtro
        $productosAgrupados = $ventasValidas
            ->flatMap->detalles
            ->groupBy('producto_id')
            ->map(function($detalles){
                $producto = $detalles->first()->producto;

                if(!$producto){
                    return null;
                }

                return (object)[
                    'nombre' => $producto->nombre,
                    'imagen' => $producto->imagen,
                    'total_vendidos' => $detalles->sum('cantidad')
                ];
            })
            ->filter()
            ->sortByDesc('total_vendidos');

        $cantidadProductos = $productosAgrupados->count();

        //top productos
        $productosMasVendidos = $productosAgrupados
            ->take(5);

        //menos vendido
        $productoMenosVendido = $productosAgrupados
            ->last();

        $pdf = \PDF::loadView('backend.admin.ventas.resumen-pdf', compact(
            'totalVendido',
            'totalPedidos',
            'ticketPromedio',
            'totalProductosVendidos',
            'clienteTop',
            'productosMasVendidos',
            'productoMenosVendido',
            'cantidadProductos',
            'estadoTop',
            'metodoEntregaTop'
        ))
        ->setPaper('a4', 'lasdscape');

        return $pdf->download('resumen-ventas-' . now()->format('d-m-Y-H-i-s') . '.pdf');
    }
}
