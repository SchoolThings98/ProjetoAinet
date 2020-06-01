@extends('layout')
@section('content')

 <form method="POST" action="{{route('password.alterar') }}" class="form-group">
    @csrf
    @method('PUT')
    <div>
        <label for="inputPasswordAtual">Password Atual</label>
        <input
            type="password" class="form-control"
            name="password" id="inputPasswordAtual"/>
    </div>
    <div>
        <label for="inputPasswordNova">Password Nova</label>
        <input
            type="password" class="form-control"
            name="password_nova" id="inputPasswordNova"/>
    @error('password_nova')
        <div class="small text-danger">{{$message}}</div>
    @enderror
    </div>
    <div>
        <label for="ConfirmarPassword">Confirmar Password</label>
        <input
            type="password" class="form-control"
            name="password_confirmada" id="ConfirmarPassword"/>
    @error('password_confirmada')
        <div class="small text-danger">{{$message}}</div>
    @enderror
    </div>
    <div>
        <button type="submit" class="btn btn-success" name="ok">Confirmar</button>
        <a href="{{route('perfil')}}" id="cancel" name="cancel" class="btn btn-default">Cancelar</a>
    </div>
</form>
@endsection