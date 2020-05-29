<div class="form-group">
        <label for="inputData">Data do Movimento</label>
        <input
            type="date" class="form-control"
            name="data" id="inputData"
            value="{{ old('data',$movimento->data) }}" />
            @if ($errors->has('data'))
                <strong><em>{{ $errors->first('data') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputValor">Valor do Movimento</label>
        <input type="text" class="form-control" name="valor" id="inputValor" value="{{old('valor', $movimento->valor )}}" >
            @if ($errors->has('valor'))
                <strong><em>{{ $errors->first('valor') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
       <input type="radio" name="tipo" id="receita" value="R" {{old('tipo',  $movimento->tipo) == 'R' ? 'checked' : ''}}>
       <label for="receita">Receita</label>
       <input type="radio" name="tipo" id="despesa" value="D" {{old('tipo',  $movimento->tipo) == 'D' ? 'checked' : ''}}>
       <label for="despesa">Despesa</label>
        @if ($errors->has('tipo'))
            <strong><em>{{ $errors->first('tipo') }}</em></strong>
        @endif
    </div>
    <div class="form-group">
       <select class="custom-select" name="categoria_id" id="inputCategoria" aria-label="Categotia:">
            <option value=" " {{'' == old('categoria_id', $movimento->categoria_id) ? 'selected' : ''}}>Sem categoria</option>
            @foreach ($categorias as $id => $nome)
                <option value={{$id}} {{$id == old('categoria_id', $movimento->categoria_id) ? 'selected' : ''}}>{{$nome}}</option>
            @endforeach
      </select>
            @if ($errors->has('categoria_id'))
                <strong><em>{{ $errors->first('categoria_id') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <div>
            <label for="inputDescricao">Descrição do Movimento</label>
        </div>
        <textarea class="form-control" name="descricao" id="desc" rows=10>{{old('descricao', $movimento->descricao)}}</textarea>
        @if ($errors->has('descricao'))
            <strong><em>{{ $errors->first('descricao') }}</em></strong>
        @endif
    </div>
    <div class="form-group">
        <label for="inputFoto">Upload do documento</label>
        <input type="file" class="form-control" name="imagem_doc" id="inputFoto">
    </div>