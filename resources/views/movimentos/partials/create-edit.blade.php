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
        <input
            type="number" class="form-control"
            name="valor" id="inputValor"
            value="{{ old('valor'), $movimento->valor}}" />
            @if ($errors->has('valor'))
                <strong><em>{{ $errors->first('valor') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputTipo">Tipo de Movimento</label>
        <select name="tipo" id="inputTipo" class="form-control">
            <option disabled selected> -- select an option -- </option>
            <option {{ old('tipo',$movimento->tipo) == 'D' ?"selected":"" }} value="D">Despesa</option>
            <option {{ old('tipo',$movimento->tipo) == 'R' ?"selected":"" }} value="R">Receita</option>
        </select>
        @if ($errors->has('tipo'))
            <strong><em>{{ $errors->first('tipo') }}</em></strong>
        @endif
    </div>
    <div class="form-group">
        <label for="inputCategoria">ID da Categoria</label>
        <input
            type="number" class="form-control"
            name="categoria_id" id="inputCategoria"
            value="{{ old('categoria_id',$movimento->categoria_id) }}" />
            @if ($errors->has('categoria_id'))
                <strong><em>{{ $errors->first('categoria_id') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputDescricao">Descrição do Movimento</label>
        <input
            type="text" class="form-control"
            name="descricao" id="inputDescricao"
            placeholder="Descrição do Movimento" value="{{ old('descricao',$movimento->descricao) }}" />
            @if ($errors->has('descricao'))
                <strong><em>{{ $errors->first('descricao') }}</em></strong>
            @endif
    </div>