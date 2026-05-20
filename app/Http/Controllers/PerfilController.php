<?php

namespace App\Http\Controllers;

use App\Models\Producto;
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
}
