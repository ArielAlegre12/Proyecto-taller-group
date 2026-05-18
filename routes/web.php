<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DomesticoController;
use App\Http\Controllers\ProduccionController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\AuthController;
use Pest\Mutate\Options\RetryOption;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('pages.principal');
});

Route::get('/principal', function () {
    return view('pages.principal');
});


Route::get('/tienda', [TiendaController::class, 'index']);//para que cargue el controller de tienda

Route::get('/servicios', function () {
    return view('pages.turnos.servicios');
});

Route::get('/informacionContactos', function () {
    return view('pages.informacionContactos');
});

Route::get('/terminosUsos', function () {
    return view('pages.terminosUsos');
});

Route::get('/consultas', function () {
    return view('pages.consultas');
});

Route::get('/quienesSomos', function () {
    return view('pages.quienesSomos');
});

Route::get('/comercializacion', function () {
    return view('pages.comercializacion');
});

Route::get('/servicios/produccion', function () {
    return view('pages.turnos.produccion');
})->name('pages.turnos.produccion');

Route::get('/servicios/domestico', function () {
    return view('pages.turnos.domestico');
})->name('pages.turnos.domestico');

Route::get('/login', function () {
    return view('pages.login');
    
})->name('login');

//prefix. se usa para agrupar las rutas y asignarles una URL en común. basicamente limpiar las urls
Route::middleware(['auth', 'rol:admin'])->prefix('backend/admin')->group(function (){
    //dashboard principal
    Route::get('/', [AdminController::class, 'dashboard']);
    
    //productos
    Route::get('/productos', [ProductosController::class, 'index']);
    Route::get('/productos/create', [ProductosController::class, 'create']);
    Route::post('/productos', [ProductosController::class, 'store']);
    
    //usuarios
    Route::get('/usuarios', [AdminController::class, 'usuarios']);

    //turnos
    Route::get('/turnos', [AdminController::class, 'turnos']);

    //ventas
    Route::get('/ventas', [AdminController::class, 'ventas']);
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'registrar']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::middleware('auth')->group(function () {
    Route::get('/perfil', [PerfilController::class, 'index'])
        ->name('perfil');
    Route::post('/produccion', [ProduccionController::class, 'store'])
        ->name('produccion.store');
    Route::post('/domestico', [DomesticoController::class, 'store'])
        ->name('domestico.store');
});
