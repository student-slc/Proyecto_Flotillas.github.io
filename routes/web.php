<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UnidadesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ObservadorController;
use App\Http\Controllers\OperadoresController;
use App\Http\Controllers\FumigadoresController;
use App\Http\Controllers\FumigacionesController;
use App\Http\Controllers\SegurosController;
use App\Http\Controllers\VerificacionesController;
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

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 */
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' =>['auth']],function(){
Route::resource('roles', RolController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('clientes', ClientesController::class);
Route::resource('unidades', UnidadesController::class);
Route::resource('operadores', OperadoresController::class);
Route::resource('fumigadores', FumigadoresController::class);
Route::resource('fumigaciones', FumigacionesController::class);
Route::resource('seguros', SegurosController::class);
Route::resource('verificaciones', VerificacionesController::class);
Route::resource('logs', ObservadorController::class);
});

///--------------------------------------UNIDADES--------------------------------------------------------------------
Route::get('/clientes/unidades/crear/{usuario}','App\Http\Controllers\UnidadesController@crear')->name('unidades.crear');

///--------------------------------------OPERADORES--------------------------------------------------------------------
Route::get('/clientes/unidades/operadores/crear/{usuario}','App\Http\Controllers\OperadoresController@crear')->name('operadores.crear');

///--------------------------------------CREAR VERIFICACIÓN--------------------------------------------------------------------
Route::get('/clientes/unidades/verificaciones/crear/{unidad}','App\Http\Controllers\VerificacionesController@crear')->name('verificaciones.crear');
