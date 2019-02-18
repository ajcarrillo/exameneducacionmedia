<?php
/**
 * Created by PhpStorm.
 * User: igna
 */
?>

@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h1 class="card-title">Expediente de aspirante</h1>
					</div>

					{!! '<pre>' . $aspirante . '</pre>' !!}

					{!! Form::model($aspirante, ['class'=>'form-horizontal']) !!}
					<div class="card-body">
						<h6 class="card-subtitle mb-2 text-muted">Datos personales</h6>
						<div class="card">
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
										{!! Form::text('user[segundo_apellido]', NULL, ['class'=>'form-control', 'required']) !!}
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										{!! Form::label('curp', 'CURP') !!}
										{!! Form::text('curp', NULL, ['class'=>'form-control', 'required']) !!}
									</div>
									<div class="form-group col-sm-4">
										{!! Form::label('fecha_nacimiento', 'Fecha nacimiento') !!}
										{!! Form::date('fecha_nacimiento', $aspirante->fecha_nacimiento, ['class'=>'form-control', 'required']) !!}
									</div>
									<div class="form-group col-sm-4">
										{!! Form::label('sexo', 'Sexo') !!}
										{!! Form::select('sexo', ['H' => 'Hombre', 'M' => 'Mujer'], $aspirante->sexo, ['class'=>'form-control', 'required']) !!}
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-6">
										{!! Form::label('user[email]', 'Correo electrónico') !!}
										{!! Form::email('user[email]', NULL, ['class'=>'form-control', 'required']) !!}
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-6">
										<label for="">Reestablecer contraseña</label>
										<input type="password" class="form-control" name="password">
									</div>
								</div>
								<hr>
								<h6 class="card-subtitle mb-2 text-muted">Información de procedencia</h6>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<label for="">Escuela de procedencia</label>
										<p class="form-control-plaintext">{{ $aspirante->informacionProcedencia->nombreCompuesto }}</p>
									</div>
									<div class="form-group col-sm-4">
										<label for="">Fecha de egreso</label>
										<p class="form-control-plaintext"> {{ $aspirante->informacionProcedencia->fecha_egreso }}</p>
									</div>
									<div class="form-group col-sm-4">
										<label for="">Primera vez en el proceso</label>
										<p class="form-control-plaintext"> {{ $aspirante->informacionProcedencia->primeraVezTexto }}</p>
									</div>
								</div>
								<hr>
							</div>
						</div>

						<h6 class="card-subtitle mb-2 text-muted">Oferta educativa</h6>
						<div class="card">
							<div class="card-body">

							</div>
						</div>
					</div>
					{!! Form::close() !!}
					<div class="card-footer">
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

