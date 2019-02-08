<?php
/**
 * Created by PhpStorm.
 * User: abalamjimenez@gmail.com
 */
?>

@extends('layouts.app')

@section('extra-head')
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('navbar-title')
	Educación Media - Administración - Responsables subsistemas
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@include('flash::message')
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<div class="card-title">Listado de Subsistemas</div>
					</div>

					<div class="card-body">
						<table class="table table-bordered table-striped table-hover" id="filtro">
							<thead>
							<tr>
								<th>#</th>
								<th>Referencia</th>
								<th>Descripción</th>
								<th>Responsable</th>
								<th>opciones</th>
							</tr>
							</thead>
							<tbody>
							@foreach($subsistemas as $subsistema)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $subsistema->referencia }}</td>
									<td>{{ $subsistema->descripcion }}</td>
									<td>
										@if(isset($subsistema->responsable))
											{!! 'USUARIO:'.$subsistema->responsable->username.'<br>NOMBRE: '.$subsistema->responsable->nombre.' '.
											$subsistema->responsable->primer_apellido.' '.$subsistema->responsable->segundo_apellido!!}
										@endif
									</td>
									<td>
										<a class="btn btn-primary btn-sm"
										   href="{{route('media.administracion.responsableSubsistema.subsistema.edit',$subsistema) }}">
											Actualizar responsable
										</a>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer"></div>
			</div>
		</div>
	</div>
@endsection

@section('extra-scripts')
	<script src="{{ asset('datatables/datatables.js') }}"></script>
	<script src="{{ mix('js/media/administracion/responsable_subsistema/eliminar.js') }}"></script>

	<script>
		$(document).ready(function () {
			$('#filtro').DataTable();
		});
	</script>
@endsection


