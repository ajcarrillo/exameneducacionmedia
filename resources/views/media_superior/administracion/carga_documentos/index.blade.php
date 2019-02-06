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
	Educación Media - Administración - Carga de documentos
@endsection

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				@include('flash::message')
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<div class="float-right">
							<a class="btn btn-primary" href="{{route('media.administracion.carga-documentos.create')}}"><i class="fa fa-plus-circle"> </i>  Adjuntar nuevo documento</a>
						</div>
					</div>
					<div class="card-body font-weight-light">
						<div class="table-responsive-sm">
							<table class="table table-bordered table-striped table-hover" id="filtro">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre del archivo</th>
										<th>Comentarios</th>
										<th>Roles</th>
										<th>Opciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach($documentos as $doc)
										<tr>
											<td>{{$loop->iteration}}</td>
											<td>{{$doc->nombre}}</td>
											<td>{{$doc->descripcion}}</td>
											<td><span class="badge badge-pill badge-primary">{{$doc->roles}}</span></td>
											<td>
												<div class="dropdown">
													<button class="btn btn-default dropdown-toggle dropdown-toggle-split" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
													        aria-expanded="false">
														Acciones
														<span class="caret"></span>
													</button>
													<div class="dropdown-menu" aria-labelledby="dropdownMenu1">
														<a  class="dropdown-item  font-weight-light" href="{{route('media.administracion.carga-documentos.descargar',$doc->id) }}"> <i class="fa fa-download"> </i>  Descargar</a>
														<a  class="dropdown-item  font-weight-light" id="eliminar" href="{{route('media.administracion.carga-documentos.eliminar',$doc->id) }}"><i class="fa fa-trash"> </i> Eliminar</a>
													</div>
												</div>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer">
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('extra-scripts')
	<script src="{{ asset('datatables/datatables.js') }}"></script>
	<script src="{{ mix('js/media/administracion/carga_documento/index_archivos.js') }}"></script>
	<script>
        $('#filtro').DataTable();
	</script>
@endsection
