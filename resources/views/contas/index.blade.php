@extends('layout')
@section('content')
<h1 class= "text-align">Contas</h1>
<h3>Lista de Contas:</h3>

<div class="row mb-3">
   <a  href="{{route('contas.create')}}" class="btn btn-success" role="button" aria-pressed="true">Nova Conta</a>
</div>

@if (session('alert-msg'))
<div>
  {{ session('alert-msg') }}
</div>
@endif

<table>
    <thead>
        <tr>
        	<th>Nome</th>
            <th>Ultimo Movimento</th>
            <th>Saldo Atual</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
   	<tbody>
    @foreach ($contas as $conta)
        <tr>
            <td>{{ $conta->nome }} </td>
            <td>{{ $conta->data_ultimo_movimento ?? '' }} </td>
            <td>{{$conta->saldo_atual}}</td>
            <td><a href="{{route('contas.edit',['conta' => $conta])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Editar Conta</a></td></td>
            <td><a href="{{route('contas.info',['conta' => $conta])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Informação sobre a Conta</td>
            <td>
                <form action="{{route('contas.destroy', ['conta' => $conta]) }}" method="POST">
                        @csrf
                        @method("DELETE")
                   	<input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                </form>
            </td>

        </tr>
    @endforeach
    </tbody>

</table>




<!--<div>{{$contas->links()}}</div>-->






@endsection('content')
