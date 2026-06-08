<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Domestico;
use App\Models\Produccion;
use Illuminate\Http\Request;
use App\Models\Venta;

class PerfilController extends Controller
{
    public function index(){

        $ventas = auth()->user()
            ->ventas()
            ->with('detalles.producto')
            ->latest()
            ->get();
        
        $usuario = auth()->user();

        $turnosDomesticos = $usuario->domesticos;

        $turnosProduccion = $usuario->producciones;

        $productos = Producto::all();

        return view('pages.perfil', compact('usuario', 'turnosDomesticos', 'turnosProduccion', 'productos', 'ventas'));
    }

    public function cancelarDomestico(Domestico $domestico){
        if($domestico->estado != 'pendiente'){
            return back()->with('error', 'Este turno ya fue confirmado');
        }

        $domestico->estado = 'cancelado';
        $domestico->save();

        return back()->with('success', 'Turno cancelado');
    }

    public function cancelarProduccion(Produccion $produccion){
        if($produccion->estado != 'pendiente'){
            return back()->with('error', 'Este turno ya fue confirmado');
        }

        $produccion->estado = 'cancelar';
        $produccion->save();

        return back()->with('success', 'Turno cancelado');
    }

    public function aceptarDomestico(Domestico $domestico){
        $domestico->estado='confirmado';

        $domestico->save();

        return back()->with('success', 'Nuevo horario confirmado');
    }

    public function aceptarProduccion(Produccion $produccion){
        $produccion->estado='confirmado';

        $produccion->save();

        return back()->with('success', 'Nuevo horario confirmado');
    }

    public function rechazarDomestico(Domestico $domestico){
        $domestico->estado = 'cancelado';

        $domestico->save();

        return back()->with('success', 'El turno fue cancelado porque el nuevo horario no fue aceptado');
    }

    public function rechazarProduccion(Produccion $produccion){
        $produccion->estado ='cancelado';

        $produccion->save();

        return back()->with('success', 'El turno fue cancelado porque el nuevo horario no fue aceptado');
    }

    //método para actualizar datos del usuario
    public function actualizar(Request $request){
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:usuarios,email,' . auth()->id(),
        ]);

        $usuario = auth()->user();

        $usuario->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('perfil')
            ->with('success', 'Perfil actualizado correctamente.');
    }
}
