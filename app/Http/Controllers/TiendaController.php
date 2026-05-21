<?php
namespace App\Http\Controllers;

use App\Models\CategoriaAnimal;
use App\Models\CategoriaProducto;
use App\Models\Producto;

class TiendaController extends Controller{
    public function index(){
        $productos = Producto::with([
            'categoriaAnimal',
            'categoriaProducto'
        ])
        ->where('activo', true)
        ->get();

        $categoriasAnimales = CategoriaAnimal::all();
        $categoriasProductos = CategoriaProducto::all();

        return view('pages.tienda', compact([
            'productos',
            'categoriasAnimales',
            'categoriasProductos'
        ]));
    }
}