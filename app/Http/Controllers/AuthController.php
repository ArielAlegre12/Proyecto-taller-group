<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\CarritoItem;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecuperarPasswordMail;

class AuthController extends Controller
{
    private function mergeSessionCartToUser(Request $request, Usuario $usuario = null)
    {
        $usuario = $usuario ?? Auth::user();
        if (!$usuario) {
            return;
        }

        $carrito = $usuario->carrito()->firstOrCreate([]);
        $sessionCarrito = $request->session()->get('carrito', []);

        if (empty($sessionCarrito)) {
            return;
        }

        foreach ($sessionCarrito as $item) {
            if (!isset($item['producto_id'], $item['cantidad'])) {
                continue;
            }

            $producto = Producto::find($item['producto_id']);
            if (!$producto || $producto->stock <= 0) {
                continue;
            }

            $cantidad = min((int) $item['cantidad'], $producto->stock);
            if ($cantidad <= 0) {
                continue;
            }

            $carritoItem = $carrito->items()
                ->where('producto_id', $producto->id)
                ->first();

            if ($carritoItem) {
                $carritoItem->cantidad = min($carritoItem->cantidad + $cantidad, $producto->stock);
                $carritoItem->save();
            } else {
                CarritoItem::create([
                    'carrito_id' => $carrito->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                ]);
            }
        }

        $request->session()->forget('carrito');
    }

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

        //crear carrito vacío para el usuario
        Carrito::create([
            'usuario_id' => $usuario->id
        ]);

        //hacemos login automatico
        Auth::login($usuario);

        //fusionar carrito de sesión de invitado con el carrito del usuario
        $this->mergeSessionCartToUser($request, $usuario);

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

            Auth::user()->carrito()->firstOrCreate([]);
            $this->mergeSessionCartToUser($request);

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
