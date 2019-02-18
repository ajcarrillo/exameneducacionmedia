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
						<div class="card card-light">
							<div class="card-header">
								<h6 class="card-subtitle text-primary">Datos personales</h6>
							</div>
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
										{!! Form::select('sexo', ['' => 'Seleccione...', 'H' => 'Hombre', 'M' => 'Mujer'], $aspirante->sexo, ['class'=>'form-control', 'required']) !!}
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
										<p class="form-control-plaintext">{{ optional($aspirante->domicilio)->localidad->NOM_LOC }}</p>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<label for="">Código postal</label>
										<p class="form-control-plaintext">{{ optional($aspirante->domicilio)->codigo_postal }}</p>
									</div>
									<div class="form-group col-sm-4">
										<label for="">País</label>
										<p class="form-control-plaintext"></p>
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
						</div>

						<div class="card card-light">
							<div class="card-header">
								<h6 class="card-subtitle text-primary">Oferta educativa</h6>
							</div>
							<div class="card-body">
								<div class="table-responsive-sm">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>Plantel</th>
												<th>Especialidad</th>
												<th>Preferencia</th>
											</tr>
										</thead>
										<tbody>
											@forelse($ofertas as $oferta)
												<tr>
													<td>{{ $loop->iteration }}</td>
													<td>{{ $oferta->seleccionOferta->plantel->descripcion }}</td>
													<td>{{ $oferta->seleccionOferta->especialidad->referencia }}</td>
													<td>{{ $oferta->preferencia }}</td>
												</tr>
											@empty
												<tr>
													<td colspan="4" class="text-center">No se encontraron registros</td>
												</tr>
											@endforelse
										</tbody>
									</table>
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

