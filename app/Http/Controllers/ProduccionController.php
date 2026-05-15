<?php

namespace App\Http\Controllers;

use App\Models\Produccion;
use Illuminate\Http\Request;

class ProduccionController extends Controller
{
    public function store(Request $request)
    {
        Produccion::create([
            'nombreProdu' => $request->nombreProdu,
            'nombreEstablo' => $request->nombreEstablo,
            'tipoAnimal' => $request->tipoAnimal,
            'cantidad' => $request->cantidad,
            'motivo' => $request->motivo,
            'tipoServicio' => $request->tipoServicio,
            'fechaYHora' => $request->fechaYHora,
        ]);

        return redirect()->back()->with('success', 'Turno guardado correctamente');
    }
}