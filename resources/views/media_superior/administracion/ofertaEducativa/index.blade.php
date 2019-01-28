@extends('layouts.app')

@section('extra-head')
@endsection

@section('navbar-title')
	Educación Media - Administración - Revisión - Oferta educativa
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<div class="card-title">Revisión<small> Oferta educativa</small></div>
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="filtro" data-toggle="dropdown" aria-haspopup="true"
							        aria-expanded="false">
								Filtrar por
								<span class="caret"></span>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenu1">
								<a class="dropdown-item" href="{{route('media.administracion.revisiones.ofertaEducativa.oferta',['estado'=>'A'])}}">Aceptado</a>
								<a class="dropdown-item" href="{{route('media.administracion.revisiones.ofertaEducativa.oferta',['estado'=>'R'])}}">En revisión</a>
								<a class="dropdown-item" href="{{route('media.administracion.revisiones.ofertaEducativa.oferta',['estado'=>'C'])}}">Cancelado</a>
								<div class="dropdown-divider"></div>
							</div>
						</div>
						<!--<a class="btn btn-primary pull-right" title="Editar" href="{{ route('media.administracion.etapasProceso.edit') }}">Editar</a>-->
					</div>
					<div class="card-body">
						<div class="table-responsive-sm">
							<table class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Subsistema</th>
										<th>Fecha de apertura</th>
										<th>Usuario apertura</th>
										<th>Estado</th>
										<th>Opciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach($revisiones as $revision)
										@if(!empty($revision->review[0]))
											<tr>
												<td>{{$loop->iteration}}</td>
												<td>{{$revision->subsistema->referencia}}</td>
												<td>{{\Jenssegers\Date\Date::parse($revision->review[0]->fecha_apertura)->format('j \\d\\e F Y')}}</td>
												<!--<td>{{\Carbon\Carbon::parse($revision->review[0]->fecha_apertura)->format('l j, F Y')}}</td>-->
												<td>{{$revision->review[0]->usuario->nombre.' '.$revision->review[0]->usuario->primer_apellido.' '.$revision->review[0]->usuario->segundo_apellido}}</td>
												<td>{{$revision->review[0]->estado}}</td>
												<td><a class="btn btn-success">XLS</a></td>
											</tr>
										@else
											<tr>
												<td colspan="6"><p class="text-center">Sin resultados.</p></td>
											</tr>
										@endif
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
@endsection