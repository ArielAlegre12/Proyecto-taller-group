<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecuperarPasswordMail;

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

            //recuperar carrito guardado del usuario
            $carrito = Auth::user()->carrito;
            session([
                'carrito' => json_decode($carrito, true) ?? []
            ]);

            //admin
            if(Auth::user()->rol_id == 1){
                return redirect('/backend/admin');
            }

            //cliente
            return redirect('/principal');
        }

        return back()->withErrors([
            'email' => 'Email o contraseña incorrectos'
        ]);
    }

    //logout
    public function logout(Request $request){
        //eliminar carrito de la sesión
        $request->session()->forget('carrito');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/principal');
    }

    public function mostrarRecuperar(){
        return view('auth.recuperar-password');
    }

    public function enviarCodigo(Request $request){
        $request->validate(['email' =>'required|email']);

        $usuario = Usuario::where('email', $request->email)->first();

        if(!$usuario){
            return back()->with('error', 'No existe una cuenta con ese email');
        }

        $codigo = rand(100000, 999999);

        DB::table('recuperar__contrasenas')->updateOrInsert(['usuario_id' => $usuario->id],['codigo'=>$codigo, 'updated_at' => now()]);
        
        Mail::to($usuario->email)->send(new RecuperarPasswordMail($codigo));

        return back()
            ->with('success', 'Se envio el codigo al correo electronico')
            ->with('email', $request->email)
            ->with('step', 'codigo');
        
    }

    public function verificarCodigo(Request $request){
        $usuario = Usuario::where('email', $request->email)->first();

        $registro = DB::table('recuperar__contrasenas')
        ->where('usuario_id', $usuario->id)
        ->where('codigo', $request->codigo)
        ->first();

        if(!$registro){
            return back()->with('error', 'Codigo Incorrecto');
        }

        return back()
        ->with('email', $request->email)
        ->with('step', 'password');
    }

    public function cambiarPassword(Request $request){
        $request->validate(['email' => 'required|email', 'password' => 'required|min:8|confirmed']);

        $usuario = Usuario::where('email', $request->email)->first();

        $usuario->password = Hash::make($request->password);

        $usuario->save();

        DB::table('recuperar__contrasenas')
            ->where('usuario_id', $usuario->id)
            ->delete();

        return redirect('/login')
            ->with('success', 'Contraseña actualizada correctamente');
    }
}
