@extends('layout')
@section('content')

<form method="POST" action="{{route('movimentos.create')}}" novalidate class="form-group">
	@csrf
    @include('movimentos.partials.create-edit')
	<input
        type="hidden" class="form-control"
        name="confirmado" value="0" />
    @can('view', Auth::user())
        <div class="form-group">
            <label for="inputConfirmado">Confirmado</label>
            <input
                type="checkbox" id="inputConfirmado"
                name="confirmado" value="1" {{ old('confirmado') == '1' ?"checked":"" }} />
        </div>
    @endcan
    <div class="form-group">
        <button type="submit" class="btn btn-primary" name="ok">Adicionar</button>
        <a href="/movimentos" id="cancel" name="cancel" class="btn btn-default">Cancelar</a>
    </div>
</form>

@endsection