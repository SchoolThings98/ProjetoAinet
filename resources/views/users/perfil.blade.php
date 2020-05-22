@extends('layout')
@section('content')

<form method="POST" action="{{route('perfil.update', Auth::user()) }}" class="form-group">
    @csrf
    @method('PUT')
    @include('users.partials.perfil-edit')
    <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
           <a href="{{route('homepage') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

@endsection
