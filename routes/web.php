<?php

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

Route::get('/usuario', function () {
    return view('auth.registro-usuarios');
});


Route::get('/template', function () {
    return view('template');
});

Route::get('/carnicero', function () {
    return view('prueba-plantilla');
});


// crear rutas para usuarios
 Route::resource('usuarios',usuarioController::class);