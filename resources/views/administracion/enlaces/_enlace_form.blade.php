<div class="form-group">
    {!! Form::label('cve_mun', 'Municipio', ['class'=>'control-label']) !!}
    {!! Form::select('cve_mun', $municipios, NULL, ['class'=>'form-control '.($errors->has('cve_mun') ? ' is-invalid' : ''), 'required', 'placeholder'=>'Seleccione...']) !!}
    @errors(['errors'=>$errors, 'field'=>'cve_mun'])
    @enderrors
</div>
<div class="form-group">
    {!! Form::label('fecha_inicio', 'Fecha inicio', ['class'=>'control-label']) !!}
    {!! Form::date('fecha_inicio', NULL, [
    'class'=>'form-control '.($errors->has('fecha_inicio') ? ' is-invalid' : ''),
    'min'=> $registro->apertura,
    'max'=>$registro->cierre,
    'required'
    ]) !!}
    @errors(['errors'=>$errors, 'field'=>'fecha_inicio'])
    @enderrors
</div>
<div class="form-group">
    {!! Form::label('fecha_fin', 'Fecha fin', ['class'=>'control-label']) !!}
    {!! Form::date('fecha_fin', NULL, [
    'class'=>'form-control '.($errors->has('fecha_fin') ? ' is-invalid' : ''),
    'min'=> $registro->apertura,
    'max'=>$registro->cierre,
    'required'
    ]) !!}
    @errors(['errors'=>$errors, 'field'=>'fecha_fin'])
    @enderrors
</div>
<div class="form-group">
    {!! Form::label('hora_inicio', 'De', ['class'=>'control-label']) !!}
    {!! Form::time('hora_inicio', NULL, ['class'=>'form-control '.($errors->has('hora_inicio') ? ' is-invalid' : ''), 'required']) !!}
    @errors(['errors'=>$errors, 'field'=>'hora_inicio'])
    @enderrors
</div>
<div class="form-group">
    {!! Form::label('hora_fin', 'A', ['class'=>'control-label']) !!}
    {!! Form::time('hora_fin', NULL, ['class'=>'form-control '.($errors->has('hora_fin') ? ' is-invalid' : ''), 'required']) !!}
    @errors(['errors'=>$errors, 'field'=>'hora_fin'])
    @enderrors
</div>
<div class="form-group">
    {!! Form::label('domicilio', 'Domicilio', ['class'=>'control-label']) !!}
    {!! Form::text('domicilio', NULL, ['class'=>'form-control '.($errors->has('domicilio') ? ' is-invalid' : ''), 'required']) !!}
    @errors(['errors'=>$errors, 'field'=>'domicilio'])
    @enderrors
</div>
<div class="form-group">
    {!! Form::label('telefono', 'Teléfono', ['class'=>'control-label']) !!}
    {!! Form::text('telefono', NULL, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('extension', 'Extensión', ['class'=>'control-label']) !!}
    {!! Form::text('extension', NULL, ['class'=>'form-control']) !!}
</div>
<input type="hidden" name="cve_ent" value="23">
