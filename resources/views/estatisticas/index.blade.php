@extends('layout')
@section('content')

<h1 class="text-align">Estatisticas</h1>
<h3>Situação Financeira:</h3>

<div>
    <span class="negrito"> Saldo total de todas as suas contas: </span> {{$saldo_total}} euros
</div>


<h4>Resume das Contas:</h4>

<table>
    <thead>
        <tr>
            <th>Conta</th>
            <th>Saldo Atual</th>
            <th>Percentagem de cada conta sobre o Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contas as $conta)
        <tr>
            <td>{{ $conta->nome }} </td>
            <td>{{$conta->saldo_atual}}</td>
            <td>{{number_format(($conta->saldo_atual *100)/$saldo_total,2)}}%</td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
<br>
<h4>Receitas e Despesas num detrminado intervalo de Tempo:</h4>
<br>
<form method="GET" action="{{route('estatistica')}}">
    @csrf
    @include('estatisticas.partials.filtro-Data')
    <button type="submit">Pesquisar</button>
</form>
<br>
<span>Intervalo de tempo definido: {{$primeiradata}} - {{$segundadata}}</span>
<table>
    <thead>
        <tr>
            <th>Intervalo de data</th>
            <th> Tipo </th>
            <th> Valor</th>
            <th>Categoria</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($todosmovimentos as $movimento)
        <tr>
            <td> {{$movimento->data}} </td>
            <td> {{$movimento->tipo_name}} </td>
            <td> {{$movimento->valor}} </td>
            <td>{{ is_null($movimento->categoria_id) ? ($movimento->tipo == 'D' ? 'Despesas não classificadas' : 'Receitas não classificadas') : $movimento->categoriaRef->nome}}</td>
        </tr>
        @endforeach
    </tbody>
    <div><a>{{$todosmovimentos->withQueryString()->links()}}</a></div>
</table>

{{-- paginação  --}}

@endsection
