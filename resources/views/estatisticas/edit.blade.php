@extends('layout')
@section('content')

<form method="POST" action="{{route('estatistica.update', ['estatistica'=>$estatistica])}}" novalidate class="form-group">
	@method('PUT')
	@csrf
    @include('estatisticas.partials.create-edit')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="ok">Guardar</button>
                <a href="{{route('estatistica')}}" id="cancel" name="cancel" class="btn btn-default">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
