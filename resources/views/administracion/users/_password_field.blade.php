<div class="form-group">
    <label for="password">Contraseña</label>
    <input type="password"
           name="password"
           id="password"
           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
           required>
    @errors(['field'=>'password'])
    @enderrors
</div>
