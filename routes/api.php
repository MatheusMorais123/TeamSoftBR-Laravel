<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

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
Route::get('/clientes', [ClienteController::class, 'index']);
Route::post('/clientes', [ClienteController::class, 'store']);
Route::get('/clientes/{id}', [ClienteController::class, 'show']);
Route::put('/clientes/{id}', [ClienteController::class, 'update']);
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);


Route::get('clientes/{id}/enderecos', [ClienteController::class, 'listarEnderecos']);
Route::post('clientes/{id}/enderecos', [ClienteController::class, 'adicionarEndereco']);
Route::delete('/clientes/{cliente_id}/enderecos/{endereco_id}', [ClienteController::class, 'removerEndereco'])->name('clientes.removerEndereco');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
