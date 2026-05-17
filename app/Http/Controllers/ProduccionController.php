<?php

namespace App\Http\Controllers;

use App\Models\Produccion;
use Illuminate\Http\Request;

class ProduccionController extends Controller
{
    public function store(Request $request)
    {
        $existeTurno= Produccion::where('fechaYHora', $request->fechaYHora)
                        ->exists();
                        
                        
                    if($existeTurno){
                        return redirect()->back()->with('error', 'Esta fecha y hora no esta disponible');
                    }

        Produccion::create([
            'usuario_id' => auth()->id(),
            'nombreProdu' => $request->nombreProdu,
            'nombreEstablo' => $request->nombreEstablo,
            'tipoAnimal' => $request->tipoAnimal,
            'cantidad' => $request->cantidad,
            'motivo' => $request->motivo,
            'tipoServicio' => $request->tipoServicio,
            'fechaYHora' => $request->fechaYHora,
        ]);

        return redirect()->back()->with('success', 'Turno Asignado Correctamente');
    }
}