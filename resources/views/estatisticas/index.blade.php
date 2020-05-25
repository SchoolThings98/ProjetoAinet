@extends('layout')
@section('content')

<h1 class= "text-align">Estatisticas</h1>
<h3>Situação Financeira:</h3>

<div>
    <span class="negrito"> Saldo total de todas as suas contas:        </span>  {{$saldo_total}} euros
</div>


 <h4>Resume das Contas:</h4>

 <table>
    <thead>
        <tr>
        	<th>Conta</th>
            <th>Saldo Atual</th>
            <th>((saldo_atual *100)/saldo_total)) Percentagem</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($contas as $conta)
      <tr>
          <td>{{ $conta->nome }} </td>
          <td>{{$conta->saldo_atual}}</td>
          <td>{{($conta->saldo_atual *100)/$saldo_total}}%</td>
      </tr>
  @endforeach
    </tbody>
 </table>
{{-- paginação  --}}
{{--<div><a>{{$movimentos->links()}}</a></div> --}}
@endsection
