@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Produtos</h2>
        </div>
        <div class="pull-right">



            <a class="btn btn-success" href="{{ route('produtos.create') }}"> + Novo Produto</a>



        </div>
    </div>
</div>

<br>

@if ($message = Session::get('success'))

<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>

@endif

<table class="table table-bordered">

 <tr>
   <th>ID</th>
   <th>Nome</th>
   <th>Descricao</th>
   <th>preco</th>
   <th width="280px">Ação</th>
 </tr>

 @foreach ($prod as $key => $produtos)

  <tr>
    <td>{{ $produtos->id }}</td>
    <td>{{ $produtos->nome }}</td>
    <td>{{ $produtos->matricula }}</td>

    <td>
       <a class="btn btn-info" href="{{ route('produtos.show',$produto->id) }}">Mostrar</a>


        <a class="btn btn-primary" href="{{ route('produtos.edit',$produto->id) }}">Editar</a>


        {!! Form::open(['method' => 'DELETE','route' => ['produtos.destroy', $vendedor->id],'style'=>'display:inline']) !!}

            {!! Form::submit('Apagar', ['class' => 'btn btn-danger']) !!}

        {!! Form::close() !!}


    </td>
  </tr>

 @endforeach

</table>

{!! $prod->render() !!}

@endsection
