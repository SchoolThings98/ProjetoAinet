@extends('layout')
@section('content')
<h1 class= "text-align">HOMEPAGE</h1>
<h3>Informação:</h3>
<p>Este website tem como principal objetivo ajudar os utilizadores a gerir as suas finanças pessoais.</p>
<p>Os utilizadores da aplicação têm um perfil publico, com o nome, email e foto (a foto é opcional),e uma área privada,onde poderãoregistar todos os seus movimentos financeiros (receitas e despesas) organizados por contas, ver um sumário do estado das suas finanças e aceder a informação estatística sobre as suas receitas e despesas.</p>
<h3>Estatisticas:</h3>
<p>Numero de Utilizadores: {{$numeroUtilizadores}}</p>
<p>Numero de Contas: {{$numeroContas}}</p>
<p>Numero de Movimentos: {{$numeroMovimentos}}</p>
@endsection