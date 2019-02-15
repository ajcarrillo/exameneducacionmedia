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
										{!! Form::text('sexo', NULL, ['class'=>'form-control', 'required']) !!}
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

