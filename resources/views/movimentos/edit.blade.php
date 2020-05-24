@extends('layout')
@section('content')

<form method="POST" action="{{route('movimentos.update', $movimento->id)}}" novalidate class="form-group">
	@method('PUT')
	@csrf
	<input type="hidden" name="id" value="{{ $movimento->id }}" />
	<div class="form-group">
        <label for="inputData">Data do Movimento</label>
        <input
            type="date" class="form-control"
            name="data" id="inputData"
            value="{{ old('data') }}" />
            @if ($errors->has('data'))
                <strong><em>{{ $errors->first('data') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputValor">Valor do Movimento</label>
        <input
            type="number" class="form-control"
            name="valor" id="inputValor"
            value="{{ old('valor') }}" />
            @if ($errors->has('valor'))
                <strong><em>{{ $errors->first('valor') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputTipo">Tipo de Movimento</label>
        <select name="tipo" id="inputTipo" class="form-control">
            <option disabled selected> -- select an option -- </option>
            <option {{ old('tipo') == 'D' ?"selected":"" }} value="D">Despesa</option>
            <option {{ old('tipo') == 'R' ?"selected":"" }} value="R">Receita</option>
        </select>
        @if ($errors->has('tipo'))
            <strong><em>{{ $errors->first('tipo') }}</em></strong>
        @endif
    </div>
    <div class="form-group">
        <label for="inputCategoria">ID da Categoria</label>
        <input
            type="number" class="form-control"
            name="categoria_id" id="inputCategoria"
            value="{{ old('categoria_id') }}" />
            @if ($errors->has('categoria_id'))
                <strong><em>{{ $errors->first('categoria_id') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputDescricao">Descrição do Movimento</label>
        <input
            type="text" class="form-control"
            name="descricao" id="inputDescricao"
            placeholder="Descrição do Movimento" value="{{ old('descricao') }}" />
            @if ($errors->has('descricao'))
                <strong><em>{{ $errors->first('descricao') }}</em></strong>
            @endif
    </div>
	<input type="hidden" name="confirmado" value="{{ $movimento->confirmado }}" />
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="ok">Guardar</button>
                <a href="/movimentos" id="cancel" name="cancel" class="btn btn-default">Cancelar</a>
            </div>
        </form>
    </div>
    <div class="col-md-6 text-right">
        @can('view', Auth::user())
        <form method="POST" action="{{route('movimentos.confirmar', $movimento->id)}}" class="form-group" novalidate>
            @method('PATCH')
            @csrf
            <button type="submit" class="btn btn-success" name="confirmado">Confirmar Movimento</button>
        </form>
        @endcan
    </div>
</div>
@endsection
