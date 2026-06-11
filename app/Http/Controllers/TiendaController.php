<?php
namespace App\Http\Controllers;

use App\Models\CategoriaAnimal;
use App\Models\CategoriaProducto;
use App\Models\Producto;
use Illuminate\Http\Request;

class TiendaController extends Controller{
    public function index(Request $request){
        $query = Producto::with([
            'categoriaAnimal',
            'categoriaProducto'
        ])->where('activo', true);

        //filtro animal
        if($request->filled('animal') && $request->animal !== 'todos'){
            $query->whereHas('categoriaAnimal', function($q) use ($request){
                $q->whereRaw('LOWER(nombre) = ?', [
                    strtolower($request->animal)
                ]);
            });
        }

        //filtro tipo
        if($request->filled('tipo') && $request->tipo !== 'todos'){
            $query->whereHas('categoriaProducto', function($q) use ($request){
                $q->whereRaw('LOWER(nombre) = ?', [
                    strtolower($request->tipo)
                ]);
            });
        }

        $productos = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categoriasAnimales = CategoriaAnimal::all();
        $categoriasProductos = CategoriaProducto::all();

        return view('pages.tienda', compact([
            'productos',
            'categoriasAnimales',
            'categoriasProductos'
        ]));
    }
}