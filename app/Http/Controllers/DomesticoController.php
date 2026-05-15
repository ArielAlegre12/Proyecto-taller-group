<?php

namespace App\Http\Controllers;

use App\Models\Domestico;
use Illuminate\Http\Request;

class DomesticoController extends Controller
{
    
    public function store(Request $request)
    {
        Domestico::create([
            'nombreDueño' => $request->nombreDueño,
            'nombreMascota' => $request->nombreMascota,
            'tipoMascota' => $request->tipoMascota,
            'motivo' => $request->motivo,
            'fechaYHora' => $request->fechaYHora
        ]);

        return redirect()->back()->with('success', 'Turno Asignado');
    }

    
}
