<?php
/**
 * Created by PhpStorm.
 * User: igna
 */
?>

@extends('layouts.app')

@section('extra-head')
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('navbar-title')
	Educación Media - Administración - Responsables planteles
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
						<div class="card-title">Listado de planteles</div>
					</div>
					<div class="card-body">
						<div class="table-responsive-sm">
							<table class="table table-bordered table-striped table-hover" id="filtro">
								<thead>
									<tr>
										<th>#</th>
										<th>Clave</th>
										<th>Descripción</th>
										<th>Responsable</th>
										<th>Subsistema</th>
										<th>opciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach($planteles as $plantel)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ $plantel->clave }}</td>
											<td>{{ $plantel->descripcion }}</td>
											<td>
												@if(isset($plantel->responsable))
													{!!$plantel->responsable->username.'<br>NOMBRE: '.$plantel->responsable->nombre.' '.
													$plantel->responsable->primer_apellido.' '.$plantel->responsable->segundo_apellido!!}
												@endif
											</td>
											<td>{{ $plantel->subsistema->descripcion }}</td>
											<td>
												<div class="dropdown">
													<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														Opciones
													</button>
													<div class="dropdown-menu" aria-labelledby="dropdownMenu1">

														@if(!isset($plantel->responsable))
														<a class="dropdown-item" href="{{route('media.administracion.responsablePlantel.plantel.edit',$plantel) }}">Asignar responsable</a>
															<a class="dropdown-item" href="{{route('media.administracion.responsablePlantel.plantel.descuentos',$plantel->id) }}">Descuentos / Opc. Educativas</a>
														@else
															<a class="dropdown-item" href="{{route('media.administracion.responsablePlantel.plantel.Actualiza_responsable ',$plantel)}}">Actualizar responsable</a>
															<a class="dropdown-item" id="eliminar"  href="{{route('media.administracion.responsablePlantel.plantel.delete_responsable',$plantel)}}">Eliminar responsable</a>
															<a class="dropdown-item" href="{{route('media.administracion.responsablePlantel.plantel.descuentos',$plantel->id) }}">Descuentos / Opc. Educativas</a>
														@endif

													</div>
												</div>
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
	</div>
@endsection

@section('extra-scripts')
	<script src="{{ asset('datatables/datatables.js') }}"></script>
	<script src="{{ mix('js/media/administracion/responsable_plantel/eliminar.js') }}"></script>

	<script>
		$(document).ready( function () {
			$('#filtro').DataTable();
		} );
	</script>
@endsection


