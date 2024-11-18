<?php

use App\Http\Controllers\areaController;
use App\Http\Controllers\componenteController;
use App\Http\Controllers\equipoController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\prestamoController;
use App\Http\Controllers\usuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login',[loginController::class,'index']) -> name('login');
Route::post('/login',[loginController::class,'login']);

Route::get('/',[homeController::class,'index']) -> name('panel');


// Ruta para visualizar activos informaticos disponibles
Route::get('/activos/disponibles',[equipoController::class, 'activosdisponibles']) -> name('activosdisponibles');

// Ruta para verficicar en tiempo real el nombre de usuario registrado mediante AJAX
Route::get('/verificar-usuario', [usuarioController::class, 'verificarusuario']);

// Ruta para verficicar en tiempo real el cod_registro registrado mediante AJAX
Route::get('/verificar-codregistro', [equipoController::class, 'verificarcodregistro']);


Route::get('/carnicero', function () {
    return view('activos-informaticos.registro-equipos');
});


// crear rutas para usuarios
Route::resource('usuarios', usuarioController::class);
// crear rutas para equipos
Route::resource('equipos', equipoController::class);
// crear rutas para componentes
Route::resource('componentes', componenteController::class);
// crear rutas para prestamos
Route::resource('prestamos', prestamoController::class);
// crear rutas para areas
Route::resource('areas',areaController::class);

/*Escucha solicitudes GET en la URL /prestamos/create/{equipo}.
Utiliza el Route Model Binding para pasar automáticamente un objeto equipo al controlador.*/
Route::get('/prestamos/create/{equipo}', [prestamoController::class, 'create'])->name('prestamos.create');


// Ruta que envia en este caso el cambio de estados en dos tablas diferentes
Route::post('/prestamos/devolucion', [PrestamoController::class, 'devolucion'])->name('prestamos.devolucion');
