@extends('layout')
@section('content')

 <form method="POST" action="{{route('contas.update', ['conta' => $conta]) }}" class="form-group">
    @csrf
    @method('PUT')
    @include('contas.partials.create-edit')
    <div class="form-group text-right">
	           <button type="submit" class="btn btn-success" name="ok">Save</button>
           <a href="{{route('contas') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection