@extends('layout')
@section('content')

<form method="POST" action="{{route('movimentos.update', ['movimento'=>$movimento])}}" novalidate class="form-group">
	@csrf
    @method('PUT')
    @include('movimentos.partials.create-edit')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="ok">Guardar</button>
                <a href="{{route('contas')}}" id="cancel" name="cancel" class="btn btn-default">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
