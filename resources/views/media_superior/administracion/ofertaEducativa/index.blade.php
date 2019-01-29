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
								<li class="dropdown-header">Estados</li>
								<a class="dropdown-item" href="{{route('media.administracion.revisiones.ofertaEducativa.oferta',['estado'=>'A'])}}">Aceptado</a>
								<a class="dropdown-item" href="{{route('media.administracion.revisiones.ofertaEducativa.oferta',['estado'=>'R'])}}">En revisión</a>
								<li class="dropdown-divider"></li>
								<li class="dropdown-header">Subsistemas</li>
								@foreach($subsistemas as $id => $referencia)
									<a class="dropdown-item" href="{{route('media.administracion.revisiones.ofertaEducativa.oferta',['subsistema_id'=>$id])}}">{{$referencia}}</a>
								@endforeach
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
										<th>Usuario revisión</th>
										<th>Opciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach($revisiones as $revision)
										@if(!empty($revision->review))
											<tr>
												<td>{{$loop->iteration}}</td>
												<td>{{$revision->subsistema->referencia}}</td>
												<td>{{Jenssegers\Date\Date::parse($revision->fecha_apertura)->format('j \\d\\e F Y')}}</td>
												<td>{{$revision->review->usuarioApertura->nombre.' '.$revision->review->usuarioApertura->primer_apellido.' '.$revision->review->usuarioApertura->segundo_apellido}}</td>
												@if($revision->review->estado == 'A')
													<td>{{'Aceptado'}}</td>
												@elseif($revision->review->estado == 'R')
													<td>{{'En revisión'}}</td>
												@elseif($revision->review->estado = 'C')
													<td>{{'Cancelado'}}</td>
												@endif
												<td>{{$revision->review->usuarioRevision->nombre.' '.$revision->review->usuarioRevision->primer_apellido.' '.$revision->review->usuarioRevision->segundo_apellido}}</td>
												<td>
													<div class="dropdown">
														<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															Opciones
														</button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenu1">
															<a class="dropdown-item" href="#">Rechazar oferta</a>
															<a class="dropdown-item" href="#">Imprimir</a>
														</div>
													</div>
												</td>
											</tr>
										@else
											<tr>
												<td colspan="7"><p class="text-center">Sin resultados.</p></td>
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