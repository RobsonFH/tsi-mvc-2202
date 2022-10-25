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

Route::prefix('v1')->group(static function(){ //prefixo para todos os endpoints

    Route::get('/vendedores', [App\Http\Controllers\vendedoresApiController::class, 'index']); //get para obter informações, chama o método index da api controller.
    Route::post('/vendedores', [App\Http\Controllers\vendedoresApiController::class, 'store']);
    Route::delete('/vendedores/{id}', [App\Http\Controllers\vendedoresApiController::class, 'destroy']);
    Route::put('/vendedores/{id}', [App\Http\Controllers\vendedoresApiController::class, 'update']);


});
