<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index(){
        
        $usuario = auth()->user();

        $turnosDomesticos = $usuario->domesticos;

        $turnosProduccion = $usuario->producciones;

        $productos = Productos::all();

        return view('pages.perfil', compact('usuario', 'turnosDomesticos', 'turnosProduccion', 'productos'));
    }
}
