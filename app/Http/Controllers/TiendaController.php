<?php
namespace App\Http\Controllers;

use App\Models\Producto;

class TiendaController extends Controller{
    public function index(){
        $productos = Producto::all();

        return view('pages.tienda', compact('productos'));
    }
}