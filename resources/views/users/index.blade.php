@extends('layout')
@section('content')
<h1 class= "text-align">Utilizadores</h1>
<h3>Lista de Utilizadores:</h3>
<form method="GET" action="{{route('users')}}">	
	@csrf
	<div>
		<p>Pesquisar por email</p>
	 	<input type="text" name="email">
	 </div>
	 <div>
	 	<p>Pesquisar por Nome</p>
	 	<input type="text" name="name">
	 </div>
	 @if (Auth::user()->adm === 1)

    	@include('users.partials.filtros-index')

	 @endif 
     <button type="submit">Pesquisar</button>
</form>

<table>
    <thead>
        <tr>
        	<th>Foto</th>
            <th>Nome</th>
            <th>Email</th>
            @if (Auth::user()->adm === 1)
            <th>Administrador</th>
            <th>Bloqueado</th>
            <th>Alterar</th>
            @endif 
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
        	<td><img src="{{$user->foto ? asset('storage/fotos/' . $user->foto) : 
            asset('img/default_img.png') }}" alt="Imagem por defeito"></td>
            <td>{{ $user->name }} </td>
            <td>{{ $user->email }} </td>
            @if (Auth::user()->adm === 1)

    			@include('users.partials.colunas-index')

			 @endif
            <td>
               
                <form action="user/{{$user->id}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div><a>{{$users->links()}}</a></div>

@endsection