<?php
/**
 * Created by PhpStorm.
 * User: igna
 */
?>

@extends('layouts.app')

@section('extra-head')
@endsection

@section('navbar-title')
	Educación Media - Administración - Asignar Responsable {{ method_field('clave') }}
@endsection

@section('content')

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<div class="card-title">Asignar Descuentos / Opciones Educativas  </div>
					</div>
					<div class="card-body">
						<form method="post" action="{{ route('media.administracion.responsablePlantel.plantel.descuentosupd', $planteles->id) }}">

							@csrf
						<div class="table-responsive-sm">
							<div class="row">

								<div class="col-md-6 form-group">
									{!! Form::label('descuento', 'Aplicar Descuento(%):', ['class'=>'control-label']) !!}
									<div class="">
										<input type="number" name="descuento" value="{{ $planteles->descuento }}" min="0" step="1" max="100" class="form-control">
									</div>
								</div>

								<div class="col-md-6 form-group">
									{!! Form::label('opciones', 'Opciones Educativas:', ['class'=>'control-label']) !!}
									<div class="">
										<input type="number" min="0" step="1" name="opciones" value="{{ $planteles->opciones }}" max="10" class="form-control">
									</div>
								</div>

							</div>

							<div class="row justify-content-center">
								<div class="col-md-4">
									<button type="submit" class="btn btn-block btn-success">Guardar</button>
								</div>
								<div class="col-md-4">
									<a href="/administracion/responsablePlantel" class="btn btn-block btn-danger">Regresar</a>
								</div>
							</div>

						</div>
						</form>
					</div>
					<div class="card-footer"></div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('extra-scripts')
@endsection


