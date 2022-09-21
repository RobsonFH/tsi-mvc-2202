<?php

use Illuminate\Support\Facades\Route;
use \App\http\Controllers\ClientesController;
use \App\http\Controllers\VendedoresController;
use \App\http\Controllers\ProdutosController;



Route::get('/', function () {
    return view('welcome');
});

route::get('/avisos', function (){


    $avisos = [ 'avisos'=>[ 0 => ['data' => '06/09/2022', 'aviso' => 'Amanhã será feriado', 'exibir' => true] ,
                            1 =>['data' => '06/09/2022', 'aviso' => 'Amanhã será feriado', 'exibir' => false],
                            2 =>['data' => '06/09/2022', 'aviso' => 'Amanhã será feriado', 'exibir' => true]]];

    return view ('avisos', $avisos);

});

Route::resource('/clientes', App\Http\Controllers\ClienteController::class);
Route::resource('/vendedores', App\Http\Controllers\VendedoresController::class);
Route::resource('/produtos', App\Http\Controllers\ProdutosController::class);

//configurando a rota para achar no browser
