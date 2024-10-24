<?php

use App\Http\Controllers\componenteController;
use App\Http\Controllers\equipoController;
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

Route::get('/', function () {
    return view('auth.login');
});


// Ruta para verficicar en tiempo real el nombre de usuario registrado mediante AJAX
Route::get('/verificar-usuario', [usuarioController::class, 'verificarusuario']);

// Ruta para verficicar en tiempo real el cod_registro registrado mediante AJAX
Route::get('/verificar-codregistro', [equipoController::class, 'verificarcodregistro']);


Route::get('/carnicero', function () {
    return view('activos-informaticos.registro-equipos');
});


// crear rutas para usuarios
 Route::resource('usuarios',usuarioController::class);
 // crear rutas para equipos
 Route::resource('equipos',equipoController::class);
  // crear rutas para componentes
  Route::resource('componentes',componenteController::class);