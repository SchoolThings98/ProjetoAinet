@extends('layout')
@section('content')
<h1 class= "text-align">Movimentos</h1>
<h3>Lista de Movimentos:</h3>
<form method="GET" action="{{route('movimentos')}}">
	@csrf
	<div>
		<p>Pesquisar por Categoria</p>
         <input type="text" name="nome">
	</div>
	<div>
	 	<p>Pesquisar por Tipo</p>
	 	<input type="text" name="tipo">
	 </div>
     <button type="submit">Pesquisar</button>
</form>

<div class="col text-right">
  @can('create', App\Moviemento::class)
  <div><a class="btn btn-primary" href="{{route('movimentos.create')}}">Adicionar Movimento</a></div>
  @endcan
</div>

<table>
    <thead>
        <tr>
        	<th>Data</th>
            <th>Valor</th>
            <th>Saldo Inicial</th>
            <th>Saldo Final</th>
            <th>Categoria do Movimento</th>
            <th>Tipo de Movimento</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($movimentos as $movimento)
      <tr>
        <td> {{$movimento->data}} </td>
        <td> {{$movimento->valor}} </td>
        <td> {{$movimento->saldo_inicial}} </td>
        <td> {{$movimento->saldo_final}} </td>
        <td> {{$movimento->categoria_id}} </td>
        <td> {{$movimento->tipo}} </td>
        <td>
          <!-- Ferramentas -->
        {{--   @can('update', $movimento)
          <div data-widget="tree">
            <div class="treeview">
              <a href="#" class=""><i class="fas fa-tools"></i></a>
              <ul class="treeview-menu">
                <a class="btn btn-xs btn-primary custom" href="{{route('movimentos.edit', $movimento->id) }}"><i class="far fa-edit"></i> Editar</a>
                <br>
                @endcan

                @can('delete', $movimento)
                <form action="{{route('movimentos.destroy', $movimento->id) }}" method="POST" role="form" class="inline">
                  @csrf
                  @method('DELETE')
                  <input type="hidden" name="id" value="{{ $movimento->id }}}">
                  <br>
                  <button type="submit" class="btn btn-xs btn-danger custom"><i class="fas fa-trash"></i> Eliminar</button>
                </form>
                @endcan
                @can('update', $movimento)
              </ul>
            </div>
          </div>
          @endcan --}}
          <!-- Ferramentas -->
        </td>
      </tr>
      @endforeach
    </tbody>
</table>
{{-- paginação  --}}
<div><a>{{$movimentos->links()}}</a></div>
@endsection
