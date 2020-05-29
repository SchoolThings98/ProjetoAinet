@extends('layout')
@section('content')
<h1 class= "text-align">Movimentos</h1>
<h3>Lista de Movimentos:</h3>
<form method="GET" action="{{route('movimentos')}}">
	@csrf
  <div>
    <p>Contas</p>
        <select class="custom-select" name="conta" id="inputConta" aria-label="Conta:">
                <option value="" {{'' == old('conta', $selectedConta) ? 'selected' : ''}}>Todas as contas</option>
        @foreach ($contas as $nome => $id)
          <option value={{$id}} {{$id == old('conta', $selectedCategoria) ? 'selected' : ''}}>{{$nome}}</option>
        @endforeach
      </select>
  </div>
	<div>
		<p>Pesquisar por Categoria</p>
        <select class="custom-select" name="categoria" id="inputCategoria" aria-label="Categotia:">
                <option value="" {{'' == old('categoria', $selectedCategoria) ? 'selected' : ''}}>Todas as categorias</option>
                <option value="" {{'' == old('departamento', $selectedCategoria) ? 'selected' : ''}}>Sem categoria</option>
        @foreach ($categorias as $nome => $id)
          <option value={{$id}} {{$id == old('categoria', $selectedCategoria) ? 'selected' : ''}}>{{$nome}}</option>
        @endforeach
      </select>
	</div>
	<div>
	 	<p>Pesquisar por Tipo</p>
	 	<input type="radio" name="tipo" id="receita" value="R">
    <label for="receita">Receita</label>
    <input type="radio" name="tipo" id="despesa" value="D">
    <label for="despesa">Despesa</label>
	 </div>
     <button type="submit">Pesquisar</button>
</form>

<div class="row mb-3">
   <a  href="{{route('movimentos.create',['movimento' => $movimentos])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Adicionar Movimento</a>
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
            <th></th>
        </tr>
    </thead>
    <tbody>
      @foreach ($movimentos as $movimento)
      <tr>
        <td> {{$movimento->data}} </td>
        <td> {{$movimento->valor}} </td>
        <td> {{$movimento->saldo_inicial}} </td>
        <td> {{$movimento->saldo_final}} </td>
        <td> {{ is_null($movimento->categoriaRef) ? '' : $movimento->categoriaRef->nome}}</td>
        <td> {{$movimento->tipo}} </td>
        <td><a href="{{route('movimentos.edit',['movimento' => $movimento])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Editar Movimento</a></td>
      </tr>
      @endforeach
    </tbody>
</table>
{{-- paginação  --}}
<div>{{$movimentos->links()}}</div>
@endsection
