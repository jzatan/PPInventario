<?php

use App\Http\Controllers\areaController;
use App\Http\Controllers\componenteController;
use App\Http\Controllers\equipoController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\mantenimientoController;
use App\Http\Controllers\prestamoController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\userController;
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
Route::get('/logout',[logoutController::class,'logout'])->name('logout');

Route::get('/',[loginController::class,'index']) -> name('login');
Route::post('/login',[loginController::class,'login']);

Route::get('/panel/dashboard',[homeController::class,'index']) -> name('panel');

//Ruta para poder visualizar todos los mantenimientos generales
Route::get('mantenimientos/generales',[mantenimientoController::class,'mantenimientosgenerales']) -> name('mantenimientosgenerales');

// Ruta para poder visualizar todos los activos informaticos registrados
Route::get('/activos/registrados',[equipoController::class,'activosregistrados']) -> name('activosregistrados');

// Ruta para visualizar activos informaticos disponibles
Route::get('/activos/disponibles',[equipoController::class, 'activosdisponibles']) -> name('activosdisponibles');

// Ruta para verficicar en tiempo real el nombre de usuario registrado mediante AJAX
Route::get('/verificar-usuario', [usuarioController::class, 'verificarusuario']);

// Ruta para verficicar en tiempo real el cod_registro registrado mediante AJAX
Route::get('/verificar-codregistro', [equipoController::class, 'verificarcodregistro']);

// Ruta para verificar en tiempo real el correo registrado mediante AJAX
Route::post('/verificar-email', [UserController::class, 'verificaremail'])->name('verificaremail');

// Ruta para verificar en tiempo real si el codigo de registro registrado mediante ajax
Route::post('/verificar-codigoregistro', [equipoController::class, 'verificarcodigoregistro'])->name('verificarcodigoregistro');

// Ruta para verificar en tiempo real si el DNI registrado mediante ajax
Route::post('/verificar-dni', [usuarioController::class, 'verificardni'])->name('verificardni');

// Ruta para verificar en tiempo real si el cod_prestamo registrado mediante ajax
Route::post('/verificar-codprestamo', [prestamoController::class, 'verificarcodprestamo'])->name('verificarcodprestamo');





Route::get('/carnicero', function () {
    return view('panel.dashboard-home');
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
// crear rutas para mantenimientos
Route::resource('mantenimientos',mantenimientoController::class);
// crear rutas para users
Route::resource('users',userController::class);
// crear rutas para roles
Route::resource('roles',roleController::class);



/*Escucha solicitudes GET en la URL /prestamos/create/{equipo}.
Utiliza el Route Model Binding para pasar automáticamente un objeto equipo al controlador.*/
Route::get('/prestamos/create/{equipo}', [prestamoController::class, 'create'])->name('prestamos.create');

Route::get('/mantenimientos/create/{equipo}',[mantenimientoController::class,'create'])->name('mantenimientos.create');


// Ruta que envia en este caso el cambio de estados en dos tablas diferentes
Route::post('/prestamos/devolucion', [PrestamoController::class, 'devolucion'])->name('prestamos.devolucion');


