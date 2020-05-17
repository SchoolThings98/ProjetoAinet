 <div>Bloqueado</div>
    <div class="form-check form-check-inline">
        <input type="radio" class="form-check-input" id="bloqueado" name="bloqueado" value="1" {{old('bloqueado',  $user->bloqueado) == 1 ? 'checked' : ''}}>
        <label class="form-check-label" for="bloqueado"> Sim </label>
        <input type="radio" class="form-check-input ml-4" id="desbloqueado" name="bloqueado" value="0" {{old('bloqueado',  $user->bloqueado) == 0 ? 'checked' : ''}}>
        <label class="form-check-label" for="desbloqueado"> Não </label>
</div>
<div>Administrador</div>
    <div class="form-check form-check-inline">
        <input type="radio" class="form-check-input" id="adm" name="adm" value="1" {{old('adm',  $user->adm) == 1 ? 'checked' : ''}}>
        <label class="form-check-label" for="adm"> Sim </label>
        <input type="radio" class="form-check-input ml-4" id="n_adm" name="adm" value="0" {{old('adm',  $user->adm) == 0 ? 'checked' : ''}}>
        <label class="form-check-label" for="n_adm"> Não </label>
</div>