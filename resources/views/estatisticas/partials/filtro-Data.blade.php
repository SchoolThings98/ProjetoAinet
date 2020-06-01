<div class="form-group">
    <label for="inputData">Data Inicial: </label>
    <input type="date" class="form-control" name="data1" id="inputData" value="data1" />
    @if ($errors->has('data1'))
    <strong><em>{{ $errors->first('data1') }}</em></strong>
    @endif
</div>
<div class="form-group">
    <label for="inputData">Data Final: </label>
    <input type="date" class="form-control" name="data2" id="inputData" value="" />
    @if ($errors->has('seconddate'))
    <strong><em>{{ $errors->first('seconddate') }}</em></strong>
    @endif
</div>
<div>
    <label>Tipos: </label>
    <input type="radio" name="tipo" id="receita" value="R">
    <label for="receita">Receita</label>
    <input type="radio" name="tipo" id="despesa" value="D">
    <label for="despesa">Despesa</label>
</div>


{{--
    {{ old('seconddate'), $todosmovimentos->data}} --}}
