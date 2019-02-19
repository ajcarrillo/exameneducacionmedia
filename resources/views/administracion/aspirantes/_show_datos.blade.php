<?php
/**
 * Created by PhpStorm.
 * User: igna
 */
?>

<div class="card-body">
	<div class="form-row">
		<div class="form-group col-sm-4">
			{!! Form::label('user[nombre]', 'Nombre') !!}
			{!! Form::text('user[nombre]', NULL, ['class'=>'form-control', 'required']) !!}
		</div>
		<div class="form-group col-sm-4">
			{!! Form::label('user[primer_apellido]', 'Primer apellido') !!}
			{!! Form::text('user[primer_apellido]', NULL, ['class'=>'form-control', 'required']) !!}
		</div>
		<div class="form-group col-sm-4">
			{!! Form::label('user[segundo_apellido]', 'Segundo apellido') !!}
			{!! Form::text('user[segundo_apellido]', NULL, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-sm-4">
			{!! Form::label('curp', 'CURP') !!}
			{!! Form::text('curp', NULL, ['class'=>'form-control']) !!}
		</div>
		<div class="form-group col-sm-4">
			{!! Form::label('fecha_nacimiento', 'Fecha nacimiento') !!}
			{!! Form::date('fecha_nacimiento', $aspirante->fecha_nacimiento, ['class'=>'form-control']) !!}
		</div>
		<div class="form-group col-sm-4">
			{!! Form::label('sexo', 'Sexo') !!}
			{!! Form::select('sexo', $sexos, $aspirante->sexo, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-sm-4">
			<label for="">Domicilio</label>
			<p class="form-control-plaintext">{{ optional($aspirante->domicilio)->direccionCompuesta }}</p>
		</div>
		<div class="form-group col-sm-4">
			<label for="">Colonia</label>
			<p class="form-control-plaintext">{{ optional($aspirante->domicilio)->colonia }}</p>
		</div>
		<div class="form-group col-sm-4">
			<label for="">Localidad</label>
			<p class="form-control-plaintext">
				@if($conDomicilio and $aspirante->domicilio->localidad)
					{{ $aspirante->domicilio->localidad->NOM_LOC }}
				@endif
			</p>
		</div>
	</div>

	<div class="form-row">
		<div class="form-group col-sm-4">
			<label for="">Código postal</label>
			<p class="form-control-plaintext">{{ optional($aspirante->domicilio)->codigo_postal }}</p>
		</div>
		<div class="form-group col-sm-4">
			<label for="">País</label>
			<p class="form-control-plaintext">{{ optional($aspirante->paisNacimiento)->descripcion }}</p>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-sm-4">
			{!! Form::label('user[email]', 'Correo electrónico') !!}
			{!! Form::email('user[email]', NULL, ['class'=>'form-control', 'required']) !!}
		</div>
		<div class="form-group col-sm-4">
			<label for="">Reestablecer contraseña</label>
			<input type="password" class="form-control" name="password">
		</div>
	</div>

	<hr>

	<h6 class="card-subtitle mb-2 text-muted">Información de procedencia</h6>
	<div class="form-row">
		<div class="form-group col-sm-4">
			<label for="">Escuela de procedencia</label>
			<p class="form-control-plaintext">{{ optional($aspirante->informacionProcedencia)->nombreCTCompuesto }}</p>
		</div>
		<div class="form-group col-sm-4">
			<label for="">Fecha de egreso</label>
			<p class="form-control-plaintext"> {{ optional($aspirante->informacionProcedencia)->fecha_egreso }}</p>
		</div>
		<div class="form-group col-sm-4">
			<label for="">Primera vez en el proceso</label>
			<p class="form-control-plaintext"> {{ optional($aspirante->informacionProcedencia)->primeraVezTexto }}</p>
		</div>
	</div>

	<hr>
</div>
