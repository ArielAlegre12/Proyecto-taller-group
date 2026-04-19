<?php
namespace App\Http\Controllers;

class TiendaController extends Controller{
    public function index(){
        $productos = require app_path('data/catalogoProductos.php');
        return view ('pages.tienda', compact('productos'));
    }
}