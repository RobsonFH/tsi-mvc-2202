<?php

use Illuminate\Support\Facades\Route;


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
