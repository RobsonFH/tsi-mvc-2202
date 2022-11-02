<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [App\Http\Controllers\APIController::class, 'login']); //usar o metodo login, com post

Route::get('logout', [App\Http\Controllers\APIController::class, 'logout']);  //usar o metodo logout, com get

Route::group(['middleware' => 'auth.jwt', 'prefix' => 'v1'], static function(){ //prefixo para todos os endpoints

    Route::get('/vendedores', [App\Http\Controllers\vendedoresApiController::class, 'index']); //get para obter informações, chama o método index da api controller.
    Route::post('/vendedores', [App\Http\Controllers\vendedoresApiController::class, 'store']);
    Route::delete('/vendedores/{id}', [App\Http\Controllers\vendedoresApiController::class, 'destroy']);
    Route::put('/vendedores/{id}', [App\Http\Controllers\vendedoresApiController::class, 'update']);
    Route::get('/vendedores/{id}', [App\Http\Controllers\vendedoresApiController::class, 'show']);

    Route::get('/clientes', [App\Http\Controllers\ClientesApiController::class, 'index']);
    Route::get('/clientes/{id}', [App\Http\Controllers\ClientesApiController::class, 'show']); //get para obter informações, chama o método index da api controller.
    Route::post('/clientes', [App\Http\Controllers\ClientesApiController::class, 'store']);
    Route::delete('/clientes/{id}', [App\Http\Controllers\ClientesApiController::class, 'destroy']);
    Route::put('/clientes/{id}', [App\Http\Controllers\ClientesApiController::class, 'update']);

    Route::get('/produtos', [App\Http\Controllers\ProdutosApiController::class, 'index']);
    Route::post('/produtos', [App\Http\Controllers\ProdutosApiController::class, 'store']);
    Route::delete('/produtos/{id}', [App\Http\Controllers\ProdutosApiController::class, 'destroy']);
    Route::get('/produtos/{id}', [App\Http\Controllers\ProdutosApiController::class, 'show']);
    Route::put('/produtos/{id}', [App\Http\Controllers\ProdutosApiController::class, 'update']);
    });

