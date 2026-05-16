<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //registro
    public function registrar(Request $request){
        $request->validate([ //validate. revisa que los datos del formu sean correctos.
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:8|confirmed',
        ]);

        //se crea una var que contiene al usuario para hacer el login automatico
        $usuario = Usuario::create([ 
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => 2
        ]);

        //hacemos login automatico
        Auth::login($usuario);

        return redirect('/principal')->with('success', 'Cuenta creada correctamente');
    }

    //login
    public function login(Request $request){
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credenciales, $request->remember)){
            $request->session()->regenerate();

            //admin
            if(Auth::user()->rol_id == 1){
                return redirect('/backend/admin');
            }

            //cliente
            return redirect('/principal');
        }

        return back()->withErrors([
            'email' => 'Email o contraaseña incorrectos'
        ]);
    }

    //logout
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/principal');
    }
}
