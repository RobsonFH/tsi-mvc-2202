@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Vendedores</h2>
        </div>
        <div class="pull-right">


        @can('vendedores-create')
            <a class="btn btn-success" href="{{ route('vendedores.create') }}"> + Novo Vendedor</a>
        @endcan


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
   <th>Matricula</th>
   <th width="280px">Ação</th>
 </tr>

 @foreach ($vend as $key => $vendedores)

  <tr>
    <td>{{ $vendedores->id }}</td>
    <td>{{ $vendedores->nome }}</td>
    <td>{{ $vendedores->matricula }}</td>

    <td>
       <a class="btn btn-info" href="{{ route('vendedores.show',$vendedores->id) }}">Mostrar</a>

       @can('vendedores-edit')

        <a class="btn btn-primary" href="{{ route('vendedores.edit',$vendedores->id) }}">Editar</a>
        @endcan

        @can('vendedores-delete')
        {!! Form::open(['method' => 'DELETE','route' => ['vendedores.destroy', $vendedores->id],'style'=>'display:inline']) !!}

            {!! Form::submit('Apagar', ['class' => 'btn btn-danger']) !!}

        {!! Form::close() !!}

        @endcan
    </td>
  </tr>

 @endforeach

</table>

{!! $vend->render() !!}

@endsection
