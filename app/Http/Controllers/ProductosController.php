<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\CategoriaAnimal;
use App\Models\CategoriaProducto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::latest()->get();
        return view('backend.admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoriasAnimales = CategoriaAnimal::all();
        $categoriasProductos = CategoriaProducto::all();
        return view('backend.admin.productos.create', compact([
            'categoriasAnimales',
            'categoriasProductos'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'imagen' => 'required|image',
            'categoria_animal_id' => 'required|exists:categoria_animales,id',
            'categoria_producto_id' => 'required|exists:categoria_productos,id'
        ]);

        $rutaImagen = $request->file('imagen')->store('productos', 'public');

        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen' => $rutaImagen,
            'categoria_animal_id' => $request->categoria_animal_id,
            'categoria_producto_id' => $request->categoria_producto_id
        ]);
        return redirect('/backend/admin')
            ->with('success', 'Producto agregado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $categoriasAnimales = CategoriaAnimal::all();
        $categoriasProductos = CategoriaProducto::all();
        return view('backend.admin.productos.edit', compact([
            'producto',
            'categoriasAnimales',
            'categoriasProductos'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'categoria_animal_id' => 'required|exists:categoria_animales,id',
            'categoria_producto_id' => 'required|exists:categoria_productos,id'
        ]);

        //si actualiza una nueva img
        if($request->hasFile('imagen')){
            $rutaImagen = $request->file('imagen')->store('productos', 'public');

            $producto->imagen = $rutaImagen;
        }

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->categoria_animal_id = $request->categoria_animal_id;
        $producto->categoria_producto_id = $request->categoria_producto_id;

        $producto->save();

        return redirect('/backend/admin/productos')
            ->with('success', 'Producto actualizado');
    }

    public function toggleActivo(Producto $producto){
        $producto->activo = !$producto->activo;
        $producto->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect('/backend/admin/productos')
            ->with('success', 'Producto eliminado');
    }

    public function storeCategoriaAnimal(Request $request){
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categoria_animales,nombre'
        ]);

        CategoriaAnimal::create([
            'nombre' => $request->nombre
        ]);

        return back()->with('success', 'Categoría creada');
    }

    public function storeCategoriaProducto(Request $request){
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categoria_productos,nombre'
        ]);

        CategoriaProducto::create([
            'nombre' => $request->nombre
        ]);

        return back()->with('success', 'Categoría creada');
    }
}
