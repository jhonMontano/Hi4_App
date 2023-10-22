<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\SesionesUsuarioController;
use App\Models\Publicacion;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/usuarios', [UsuariosController::class, 'listar']);
Route::post('/usuarios/crear', [UsuariosController::class, 'crear']);
Route::put('/usuario/editar/{id}', [UsuariosController::class, 'editar']);
Route::delete('/usuario/eliminar/{id}', [UsuariosController::class, 'eliminar']);

Route::get('/publicaciones', [PublicacionController::class, 'listarPublicaciones']);
Route::post('/publicaciones/crear', [PublicacionController::class, 'crearPublicacion']);
Route::put('/publicacion/editar/{id}', [PublicacionController::class, 'editarPublicacion']);
Route::delete('/publicacion/eliminar/{id}', [PublicacionController::class, 'eliminarPublicacion']);

Route::get('/sesionesUsuario', [SesionesUsuarioController::class, 'listarSesionesUsuario']);
Route::post('/sesionUsuario/crear', [SesionesUsuarioController::class, 'crearSesionUsuario']);
Route::put('/sesionUsuario/editar/{id}', [SesionesUsuarioController::class, 'editarSesionUsuario']);
Route::delete('/sesionUsuario/eliminar/{id}', [SesionesUsuarioController::class, 'eliminarSesionUsuario']);


