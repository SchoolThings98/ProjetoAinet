@extends('layout')
@section('content')

 <form method="POST" action="{{route('users.update', ['user' => $user]) }}" class="form-group">
    @csrf
    @method('PUT')
    @include('users.partials.create-edit')
    <div class="form-group text-right">
	           <button type="submit" class="btn btn-success" name="ok">Save</button>
           <a href="{{route('users') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
