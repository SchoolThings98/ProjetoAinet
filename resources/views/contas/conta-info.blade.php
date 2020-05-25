@extends('layout')
@section('content')
<h1 class= "text-align">Informação de conta</h1>
<table>
    <thead>
        <tr>
        	<th>Nome</th>
            <th>Ultimo Movimento</th>
            <th>Saldo Atual</th>
            <th></th>
        </tr>
    </thead>
   	<tbody>
        <tr>
            <td>{{ $conta->nome }} </td>
            <td>{{ $conta->data_ultimo_movimento ?? '' }} </td>
            <td>{{$conta->saldo_atual}}</td>
            <td><a href="{{route('contas.edit',['conta' => $conta])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Editar Conta</a></td></td> 
        </tr>
    </tbody>
</table>

<h3>Lista de Movimentos:</h3>

<table>
    <thead>
        <tr>
        	<th>Id</th>
            <th>Data</th>
            <th>Valor</th>
            <th>Saldo Inicial</th>
            <th>Saldo Final</th>
            <th>Categorias</th>
            <th>Tipo</th>
        </tr>
    </thead>
   	<tbody>
   		@foreach ($movimentos as $movimento)
        	<tr>
            	<td>{{ $movimento->id }} </td>
            	<td>{{ $movimento->data }} </td>
           		<td>{{$movimento->valor}}</td>
            	<td>{{$movimento->saldo_inicial}}</td>
                <td>{{$movimento->saldo_final}}</td>
                <td>{{$movimento->categoria_id}}</td>
                <td>{{$movimento->tipo}}</td>
        	</tr>
        @endforeach	
    </tbody>
</table>

<div>{{$movimentos->links()}}</div>
@endsection
