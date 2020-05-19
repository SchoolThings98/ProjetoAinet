<div class="form-group">
    <label for="Nome">Nome</label>
    <input type="text" class="form-control" name="name" id="Nome" value="{{old('name', Auth::user()->name )}}" >
    <!--
		em cima no value tirei ?? ''->name entre user() e ->name para nao mostrar a info toda
    @error('name')
        <div class="small text-danger">{{$message}}</div>
    @enderror-->
</div>
<div class="form-group">
    <label for="Mail">Mail</label>
    <input type="text" class="form-control" name="email" id="Mail" value="{{old('email', Auth::user()->email )}}" >
</div>
<div class="form-group">
    <label for="Nif">NIF</label>
    <input type="text" class="form-control" name="NIF" id="Nif" value="{{old('NIF', Auth::user()->NIF )}}" >
</div>
<div class="form-group">
    <label for="Telefone">Telefone</label>
    <input type="text" class="form-control" name="telefone" id="Telefone" value="{{old('telefone', Auth::user()->telefone )}}" >
</div>