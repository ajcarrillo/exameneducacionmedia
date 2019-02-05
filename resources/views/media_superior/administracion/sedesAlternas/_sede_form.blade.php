<div class="form-group">
    {!! Form::label('descripcion', 'Descripción', ['class'=>'control-label']) !!}
    {!! Form::text('descripcion', NULL, ['class'=>'form-control '.($errors->has('descripcion') ? ' is-invalid' : ''), 'required']) !!}
    @errors(['errors'=>$errors, 'field'=>'descripcion'])
    @enderrors
</div>
<div class="form-group">
    {!! Form::label('plantel_id', 'Plantel', ['class'=>'control-label']) !!}
    {!! Form::select('plantel_id', $planteles, NULL, ['class'=>'form-control '.($errors->has('plantel_id') ? ' is-invalid' : ''), 'required', 'placeholder'=>'Seleccione...']) !!}
    @errors(['errors'=>$errors, 'field'=>'plantel_id'])
    @enderrors
</div>

<div class="form-group">
    {!! Form::label('cve_mun', 'Municipio', ['class'=>'control-label']) !!}
    {!! Form::select('cve_mun', $municipios, NULL, ['id'=>'cve_mun','class'=>'form-control '.($errors->has('cve_mun') ? ' is-invalid' : ''), 'required', 'placeholder'=>'Seleccione...']) !!}
    @errors(['errors'=>$errors, 'field'=>'cve_mun'])
    @enderrors
</div>

<div class="form-group">
    {!! Form::label('cve_loc', 'Localidad', ['class'=>'control-label']) !!}
    {!! Form::select('cve_loc', $localidades, NULL, ['id'=>'cve_loc','class'=>'form-control '.($errors->has('cve_loc') ? ' is-invalid' : ''), 'required', 'placeholder'=>'Seleccione...']) !!}
    @errors(['errors'=>$errors, 'field'=>'cve_loc'])
    @enderrors
</div>
<div class="form-row pb-3">
    <div class="col">
        <label for="">Calle</label>
        <input class="form-control" name="calle" required type="text" >
    </div>
    <div class="col">
        <label for="numero">Número</label>
        <input class="form-control" name="numero" required type="text" >
    </div>
</div>
<div class="form-group">
    <label for="">Colonia</label>
    <input class="form-control" name="colonia" required type="text" >
</div>
<div class="form-group">
    <label for="">Código postal</label>
    <input class="form-control" name="codigo_postal" type="text" >
</div>
<input type="hidden" name="cve_ent" value="23">

<input type="hidden" name="sede_ceneval" value="00">
|