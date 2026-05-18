<?php

namespace App\Http\Controllers;

use App\Models\Domestico;
use Illuminate\Http\Request;

class DomesticoController extends Controller
{
    public function store(Request $request)
    {
        $existeTurno = Domestico::where('fechaYHora', $request->fechaYHora)
                        ->exists();

                if($existeTurno){
                    return redirect()->back()->with('error', 'Esa fecha y hora no estan disponible');
                }   

        Domestico::create([
            'usuario_id' => auth()->id(),
            'nombreDueño' => $request->nombreDueño,
            'nombreMascota' => $request->nombreMascota,
            'tipoMascota' => $request->tipoMascota,
            'motivo' => $request->motivo,
            'fechaYHora' => $request->fechaYHora,
            'estado' => 'pendiente'
        ]);

        return redirect()->back()->with('success', 'Turno Asignado Correctamente');
    }

    
}
