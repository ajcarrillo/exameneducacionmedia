<?php
/**
 * Created by PhpStorm.
 * User: igna
 */
?>

@extends('layouts.app')

@section('navbar-title')
	Administración - Expediente de aspirante
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h1 class="card-title">Expediente de aspirante</h1>
					</div>
					{!! Form::model($aspirante, ['route' => ['media.administracion.aspirantes.update', $aspirante->id], 'class'=>'form-horizontal', 'method'=>'POST']) !!}
					<div class="card-body">
						<div class="card card-light">
							<div class="card-header">
								<h6 class="card-subtitle text-primary">Datos personales</h6>
							</div>
							@include('administracion.aspirantes._show_datos')
						</div>

						<div class="card card-light">
							<div class="card-header">
								<h6 class="card-subtitle text-primary">Oferta educativa</h6>
							</div>
							@include('administracion.aspirantes._show_oferta')
						</div>

						<div class="card card-light">
							<div class="card-header">
								<h6 class="card-subtitle text-primary">información de registro</h6>
							</div>
							@include('administracion.aspirantes._show_revision')
						</div>
					</div>
					<div class="card-footer">
						<button type="submit" class="btn btn-success">Guardar</button>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@stop