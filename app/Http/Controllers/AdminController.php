<?php

namespace App\Http\Controllers;

use App\Models\Domestico;
use App\Models\Produccion;
use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Venta;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $totalProductos = Producto::count();
        $totalUsuarios = Usuario::count();

        //sumamos los turnos domesticos/producción
        $totalTurnos = Domestico::count() + Produccion::count();

        //productos con stock bajo
        $stockBajo = Producto::where('stock', '<=', 5)->count();

        //actividad reciente
        $ultimosProductos = Producto::latest()->take(3)->get();
        $ultimosUsuarios = Usuario::latest()->take(3)->get();
        $ultimosTurnosDomesticos = Domestico::latest()->take(3)->get();
        $ultimosTurnosProduccion = Produccion::latest()->take(3)->get();


        return view('backend.admin.dashboard', compact(
            'totalProductos',
            'totalUsuarios',
            'totalTurnos',
            'stockBajo',
            'ultimosProductos',
            'ultimosUsuarios',
            'ultimosTurnosDomesticos',
            'ultimosTurnosProduccion'
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

        $turnosDomesticos = Domestico::latest()->get();
        $turnosProduccion = Produccion::latest()->get();

        return view('backend.admin.turnos.index', compact(
            'turnosDomesticos',
            'turnosProduccion'
        ));
    }

    public function confirmarDomestico(Domestico $domestico){
        $domestico->estado = 'confirmado';
        $domestico->save();

        return back()->with('success', 'Turno confirmado');
    }
    
    public function cancelarDomestico(Domestico $domestico){
        $domestico->estado = 'cancelado';
        $domestico->save();

        return back()->with('success', 'Turno cancelado');
    }

    public function reprogramarDomestico(Request $request, Domestico $domestico){
        $request->validate([
            'fechaYHora' => 'required|date'
        ]);

        $domestico->fechaYHora = $request->fechaYHora;

        //vuelve a pendiente
        $domestico->estado = 'pendiente';

        $domestico->save();

        return back()->with('success', 'Turno repogramado');
    }

    public function confirmarProduccion(Produccion $produccion){
        $produccion->estado = 'confirmado';
        $produccion->save();

        return back()->with('success', 'Turno confirmado');
    }

    public function cancelarProduccion(Produccion $produccion){
        $produccion->estado = 'cancelado';
        $produccion->save();

        return back()->with('success', 'Turno cancelado');
    }

    public function reprogramarProduccion(Request $request, Produccion $produccion){
        $request->validate([
            'fechaYHora' => 'required|date'
        ]);

        $produccion->fechaYHora = $request->fechaYHora;

        $produccion->estado = 'pendiente';

        $produccion->save();

        return back()->with('success', 'Turno reprogramado');
    }

    public function ventas(){
        $ventas = Venta::with('usuario')
            ->latest()
            ->get();
        return view('backend.admin.ventas.index', compact('ventas'));
    }

    public function marcarPagado(Venta $venta){
        $venta->estado = 'pagado';
        $venta->save();

        return back();
    }

    public function marcarEnviado(Venta $venta){
        $venta->estado = 'enviado';
        $venta->save();

        return back();
    }

    public function marcarEntregado(Venta $venta){
        $venta->estado = 'entregado';
        $venta->save();

        return back();
    }
}
