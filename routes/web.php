<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DomesticoController;
use App\Http\Controllers\ProduccionController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\AuthController;
use Pest\Mutate\Options\RetryOption;
use Illuminate\Support\Facades\Auth;
use function Pest\Laravel\put;

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
    Route::get('/productos/create', [ProductosController::class, 'create']);//crear
    Route::post('/productos', [ProductosController::class, 'store']);
    Route::get('/productos/{producto}/edit', [ProductosController::class, 'edit']);//editar
    Route::put('/productos/{producto}', [ProductosController::class, 'update']);
    Route::delete('/productos/{producto}', [ProductosController::class, 'destroy']);
    Route::put('/productos/{producto}/toggle', [ProductosController::class, 'toggleActivo']);
    
    //usuarios
    Route::get('/usuarios', [AdminController::class, 'usuarios']);
    Route::get('/usuarios/{usuario}', [AdminController::class, 'showUsuario']);
    Route::delete('/usuarios/{usuario}', [AdminController::class, 'destroyUsuario']);
    Route::put('/usuarios/{usuario}/rol', [AdminController::class, 'cambiarRol']);

    //turnos
    Route::get('/turnos', [AdminController::class, 'turnos']);
    Route::put('/turnos/domesticos/{domestico}/confirmar', [AdminController::class, 'confirmarDomestico']);
    Route::put('/turnos/domesticos/{domestico}/cancelar', [AdminController::class, 'cancelarDomestico']);
    Route::put('/turnos/domesticos/{domestico}/reprogramar', [AdminController::class, 'reprogramarDomestico']);
    Route::put('/turnos/produccion/{produccion}/confirmar', [AdminController::class, 'confirmarProduccion']);
    Route::put('/turnos/produccion/{produccion}/cancelar', [AdminController::class, 'cancelarProduccion']);
    Route::put('/turnos/produccion/{produccion}/reprogramar', [AdminController::class, 'reprogramarProduccion']);

    //ventas
    Route::get('/ventas', [AdminController::class, 'ventas']);
    Route::put('/ventas/{venta}/pagado', [AdminController::class, 'marcarPagado']);
    Route::put('/ventas/{venta}/enviado', [AdminController::class, 'marcarEnviado']);
    Route::put('/ventas/{venta}/entregado', [AdminController::class, 'marcarEntregado']);
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
    Route::get('/compra', [ClienteController::class, 'checkout'])
        ->name('cliente.checkout');
    Route::post('/guardar-carrito', [ClienteController::class, 'guardarCarrito']);
    Route::post('/compra/finalizar', [ClienteController::class, 'finalizarCompra'])
        ->name('cliente.finalizarCompra');
});

Route::get('/recuperar-password', [AuthController::class, 'mostrarRecuperar'])
        ->name('password.request');
Route::post('/recuperar-password/email', [AuthController::class, 'enviarCodigo'])
        ->name('password.email');
Route::post('/recuperar-password/codigo', [AuthController::class, 'verificarCodigo'])
        ->name('password.codigo');
Route::post('/recuperar-password/cambiar', [AuthController::class, 'cambiarPassword'])
        ->name('password.cambiar');