<?php

namespace App\Http\Controllers;

use App\Models\Producto;
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
        return view('backend.admin.productos.create');
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
            'animal' => 'required',
            'tipo' => 'required'
        ]);

        $rutaImagen = $request->file('imagen')->store('productos', 'public');

        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen' => $rutaImagen,
            'animal' => $request->animal,
            'tipo' => $request->tipo
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
        return view('backend.admin.productos.edit', compact('producto'));
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
            'animal' => 'required',
            'tipo' => 'required'
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
        $producto->animal = $request->animal;
        $producto->tipo = $request->tipo;

        $producto->save();

        return redirect('/backend/admin/productos')
            ->with('success', 'Producto actualizado');
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
}
