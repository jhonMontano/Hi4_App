<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

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
//Route::get('/usuarios/crear', [UsuariosController::class, 'create']);
/* Route::get('/usuarios/{id}', [UsuariosController::class, 'show']);
Route::get('/usuarios/{id}/editar', [UsuariosController::class, 'edit']);
Route::put('/usuarios/{id}', [UsuariosController::class, 'update']);
Route::delete('/usuarios/{id}', [UsuariosController::class, 'destroy']);
 */
