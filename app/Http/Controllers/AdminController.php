<?php

namespace App\Http\Controllers;

use App\Models\Domestico;
use App\Models\Produccion;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $totalProductos = Producto::count();
        $totalUsuarios = Usuario::count();

        //sumamos los turnos domesticos/producción
        $totalTurnos = Domestico::count() + Produccion::count();

        //productos con stock bajo
        $stockBajo = Producto::where('stock', '<=', 5)->count();

        //actividad reciente
        $ultimosProductos = Producto::latest()->take(3)->get();
        $ultimosUsuarios = Usuario::latest()->take(3)->get();
        $ultimosTurnosDomesticos = Domestico::latest()->take(3)->get();
        $ultimosTurnosProduccion = Produccion::latest()->take(3)->get();


        return view('backend.admin.dashboard', compact(
            'totalProductos',
            'totalUsuarios',
            'totalTurnos',
            'stockBajo',
            'ultimosProductos',
            'ultimosUsuarios',
            'ultimosTurnosDomesticos',
            'ultimosTurnosProduccion'
        ));
    }

    public function usuarios(){
        return view('backend.admin.usuarios.index');
    }

    public function turnos(){
        return view('backend.admin.turnos.index');
    }

    public function ventas(){
        return view('backend.admin.ventas.index');
    }
}
