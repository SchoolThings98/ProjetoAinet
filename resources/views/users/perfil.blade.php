@extends('layout')
@section('content')


@if (session('alert-msg'))
<div>
  {{ session('alert-msg') }}
</div>
@endif

<form method="POST" action="{{route('perfil.update',['user'=>$user] ) }}" class="form-group">
    @csrf
    @method('PUT')
    @include('users.partials.perfil-edit')
    @empty($user->foto)
        @else
            <div class="form-group">
                <img src="{{$user->foto ? asset('storage/fotos/' . $user->foto) : asset('img/default_img.png') }}"
                     alt="Foto de perfil"  class="img-profile"
                     style="max-width:100%">
            </div>
        @endempty
        <div class="form-group text-right">
            @empty($user->foto)
            @else
                    <button type="submit" class="btn btn-danger" name="deletefoto" form="form_delete_photo">Apagar Foto</button>
            @endempty
                    <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('homepage') }}" class="btn btn-secondary">Cancel</a>
        </div>
</form>
 <form id="form_delete_photo" action="{{route('perfil.foto.destroy', ['user' => $user])}}" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection
