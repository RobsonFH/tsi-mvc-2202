<?php

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

Route::get('/', function () {
    return view('welcome');
});

route::get('/avisos', function (){


    $avisos = [ 'avisos'=>[ 0 => ['data' => '06/09/2022', 'aviso' => 'Amanhã será feriado', 'exibir' => true] ,
                            1 =>['data' => '06/09/2022', 'aviso' => 'Amanhã será feriado', 'exibir' => false],
                            2 =>['data' => '06/09/2022', 'aviso' => 'Amanhã será feriado', 'exibir' => true]]];

    return view ('avisos', $avisos);

});
