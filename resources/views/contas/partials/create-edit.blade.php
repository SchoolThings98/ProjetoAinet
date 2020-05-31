<div class="form-group">
    <label for="nomeConta">Nome</label>
    <input type="text" class="form-control" name="nome" id="nomeConta" value="{{old('nome', $conta->nome)}}" >
    @error('nome')
        <div class="small text-danger">Nome tem de ser unico ou no máximo de 20 carateres</div>
    @enderror
</div>
<div class="form-group">
	<div>
    	<label for="desc">Descrição</label>
    </div>
    <textarea class="form-control" name="descricao" id="desc" rows=10>{{old('descricao', $conta->descricao)}}</textarea>
</div>
<div class="form-group">
    <label for="saldoInicial">Saldo de Abertura</label>
    <input type="text" class="form-control" name="saldo_abertura" id="saldoInicial" value="{{old('saldo_abertura', $conta->saldo_abertura)}}" >
    @error('saldo_abertura')
        <div class="small text-danger">Tem de ser um valor numerico</div>
    @enderror
</div>
<div class="form-group">
    <label for="Mail">Adicionar Permissão</label>
    <input type="text" class="form-control" name="email" id="Mail">
    @error('email')
        <div class="small text-danger">Tem de inserir um email válido</div>
    @enderror
</div>