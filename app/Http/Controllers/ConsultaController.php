<?php

namespace App\Http\Controllers;

use App\Mail\ConsultaMail;
use App\Models\Consulta;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ConsultaController extends Controller
{
    public function store(Request $request){
       $request->validate(['nombre' => 'required', 'telefono' => 'required', 'email' => 'required|email', 'tipo_animal' => 'required', 'tipo_consulta' => 'required', 'fecha_hora' => 'required', 'descripcion' => 'required']);

       $consulta = Consulta::create(['usuario_id' => Auth::id(), 'nombre' => $request->nombre, 'telefono' => $request->telefono, 'email' => $request->email,
       'tipo_animal' => $request->tipo_animal, 'nombre_animal' => $request->nombre_animal, 'especie' => $request->especie, 'tipo_campo' => $request->tipo_campo, 'raza' => $request->raza, 'edad' => $request->edad, 'peso' => $request->peso, 'tipo_consulta' => $request->tipo_consulta, 'fecha_hora' => $request->fecha_hora, 'descripcion' => $request->descripcion]);

       $admins = Usuario::where('rol_id', 1)->get();

       foreach($admins as $admin){
        Mail::to($admin->email)->send(new ConsultaMail($consulta));
       }

       return back()->with('success', 'Consulta enviada correctamente');
}
}