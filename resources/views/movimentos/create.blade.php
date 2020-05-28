@extends('layout')
@section('content')

<form method="POST" action="{{route('movimentos.store')}}"  class="form-group">
	@csrf
    @include('movimentos.partials.create-edit')

    <div class="form-group">
        <button type="submit" class="btn btn-primary" name="ok">Adicionar</button>
        <a href="{{route('contas')}}" id="cancel" name="cancel" class="btn btn-default">Cancelar</a>
    </div>
</form>

@endsection