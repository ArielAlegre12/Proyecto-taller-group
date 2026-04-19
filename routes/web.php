<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendaController;

Route::get('/', function () {
    return view('pages.principal');
});

Route::get('/principal', function () {
    return view('pages.principal');
});


Route::get('/tienda', [TiendaController::class, 'index']);//para que cargue el controller de tienda

Route::get('/servicios', function(){
    return view('pages.turnos.servicios');
});

Route::get('/informacionContactos', function(){
    return view('pages.informacionContactos');
});

Route::get('/terminosUsos', function(){
    return view('pages.terminosUsos');
});

Route::get('/consultas', function(){
    return view('pages.consultas');
});

Route::get('/quienesSomos', function(){
    return view('pages.quienesSomos');
});

Route::get('/comercializacion', function(){
    return view('pages.comercializacion');
});

Route::get('/servicios/produccion', function(){
    return view('pages.turnos.produccion');
})->name('pages.turnos.produccion');

Route::get('/servicios/domestico', function(){
    return view('pages.turnos.domestico');
})->name('pages.turnos.domestico');

