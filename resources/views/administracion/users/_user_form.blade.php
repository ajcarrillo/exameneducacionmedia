<div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text"
           name="nombre"
           id="nombre"
           class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}"
           value="{{ old('nombre', $user->nombre) }}"
           required
           autofocus>
    @errors(['field'=>'nombre'])
    @enderrors
</div>
<div class="form-group">
    <label for="primer_apellido">Primer apellido</label>
    <input type="text"
           name="primer_apellido"
           id="primer_apellido"
           class="form-control{{ $errors->has('primer_apellido') ? ' is-invalid' : '' }}"
           value="{{ old('primer_apellido', $user->primer_apellido) }}"
           required>
    @errors(['field'=>'primer_apellido'])
    @enderrors
</div>
<div class="form-group">
    <label for="segundo_apellido">Segundo apellido</label>
    <input type="text"
           name="segundo_apellido"
           id="segundo_apellido"
           class="form-control"
           value="{{ old('segundo_apellido', $user->segundo_apellido) }}">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="email"
           name="email"
           id="email"
           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
           value="{{ old('email', $user->email) }}"
           required>
    @errors(['field'=>'email'])
    @enderrors
</div>
@includeWhen($isCreate, 'administracion.users._password_field')
<div class="form-group">
    <label for="">Roles:</label>
    <br>
    @foreach($roles as $role)
        <label class="checkbox-inline pr-3">
            <input type="checkbox"
                   name="roles[{{ $role }}]"
                   id="{{ $role }}"
                   value="{{$role}}"
                {{ $errors->any() ? old("roles.{$role}") : $user->roles()->pluck('name')->contains($role) ? 'checked' : '' }}>
            {{ $role }}
        </label>
    @endforeach
    <br>
    @if ($errors->has('roles'))
        <span style="font-size: 80%; color: #dc3545" role="alert">
            <strong>{{ $errors->first('roles') }}</strong>
        </span>
    @endif
</div>
