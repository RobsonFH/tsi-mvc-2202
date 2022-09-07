@extends('layouts.padrao')
@section('title','Quadro de avisos')
@section('sidebar')
    @parent
    <br>========= Barra Superior Especifica =========
@endsection
@section('content')

    <h1>Quadro de avisos</h1>
    <br>
    <br>
    @foreach($avisos as $aviso)

         @if($aviso['exibir'])
            {{$aviso['data']}}: {{$aviso['aviso']}}

        @endif

     @endforeach

     <?php
    foreach($avisos as $aviso){

        if($aviso['exibir']){
            echo"{$aviso['data']}: {$aviso['aviso']} <br>";

        }else{
            echo"Não há aviso <br>";
        }
    }

?>

@endsection
