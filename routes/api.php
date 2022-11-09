<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EstudiantesController;
use App\Http\Controllers\Verificacion_2pasos;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//---------------------------------------------------
Route::middleware('auth:sanctum')->group(function(){

    Route::get('/Usuarios', [UsuarioController::class, 'obtener'])->middleware('auth:sanctum');
    Route::post('/Usuarios', [UsuarioController::class, 'crear']);
    Route::put('/Usuarios/{id}', [UsuarioController::class, 'modificar']);
    Route::delete('/Usuarios/{id}', [UsuarioController::class, 'eliminar']);

    //---------------------------------------------------
    Route::get('/Tienda/', [TiendaController::class, 'obtenerProducto']);
    Route::post('/Tienda/', [TiendaController::class, 'CrearProducto']);
    Route::put('/Tienda/{id}', [TiendaController::class, 'ModificarProducto']);
    Route::delete('/Tienda/{id}', [TiendaController::class, 'EliminarProducto']);
    //---------------------------------------------------

    Route::get('/Ventas/', [VentaController::class, 'obtener']);
    Route::post('/Ventas/', [VentaController::class, 'crear']);
});



Route::post('/Login',[Login::class, 'Login']);


Route::put('/Usuarios/{id}',[UsuarioController::class, 'CambioPass']);
Route::put('/Usuarios/Code/{id}',[UsuarioController::class, 'Verificacion']);



