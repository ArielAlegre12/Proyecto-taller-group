<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //registro
    public function register(Request $request){
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:8|confirmed',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => $request->password,
            'rol_id' => 2
        ]);

        return redirect('/login')->with('sucess', 'Cuenta creada correctamente');
    }

    //login
    public function login(Request $request){
        $credenciales = $request->only('email', 'password');

        if(Auth::attempt($credenciales, $request->remember)){
            $request->session()->regenerate();

            return redirect('principal');
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas'
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
