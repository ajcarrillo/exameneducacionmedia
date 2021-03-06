@extends('layouts.app')

@section('extra-head')
@endsection

@section('navbar-title')
	Educación Media - Administración - Revisión - Aforo
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="row">
				<div class="col-md-12">
					@include('flash::message')
				</div>
			</div>
			<div class="col-md-12">
				<div class="overlay overlay-oferta" style="display: none">
					<i class="fa fa-refresh fa-spin"></i>
				</div>
				<div class="card card-primary card-outline">
					<div class="card-header">
						<div class="card-title">Revisión
							<small> Aforo</small>
						</div>
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="filtro" data-toggle="dropdown" aria-haspopup="true"
							        aria-expanded="false">
								Filtrar por
								<span class="caret"></span>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenu1">
								<li class="dropdown-header">Estados</li>
								<a class="dropdown-item" href="{{route('media.administracion.revisiones.aforo.aforo',['estado'=>'A'])}}">Aceptado</a>
								<a class="dropdown-item" href="{{route('media.administracion.revisiones.aforo.aforo',['estado'=>'R'])}}">En revisión</a>
								<li class="dropdown-divider"></li>
								<li class="dropdown-header">Subsistemas</li>
								@foreach($subsistemas as $id => $referencia)
									<a class="dropdown-item" href="{{route('media.administracion.revisiones.aforo.aforo',['subsistema_id'=>$id])}}">{{$referencia}}</a>
								@endforeach
							</div>
						</div>
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
										@if(!empty($estado))
											<tr>
												<td>{{$loop->iteration}}</td>
												<td>{{$revision->revision->subsistema->referencia}}</td>
												<td>{{Jenssegers\Date\Date::parse($revision->fecha_apertura)->format('j \\d\\e F Y')}}</td>
												<td>{{$revision->usuarioApertura->nombre.' '.$revision->usuarioApertura->primer_apellido.' '.$revision->usuarioApertura->segundo_apellido}}</td>
												@if($revision->estado == 'A')
													<td>{{'Aceptado'}}</td>
												@elseif($revision->estado == 'R')
													<td>{{'En revisión'}}</td>
												@elseif($revision->estado = 'C')
													<td>{{'Cancelado'}}</td>
												@endif
												@if(!empty($revision->usuario_revision))
													<td>{{$revision->usuarioRevision->nombre.' '.$revision->usuarioRevision->primer_apellido.' '.$revision->usuarioRevision->segundo_apellido}}</td>
												@else
													<td></td>
												@endif
												<td>
													<div class="dropdown">
														<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															Opciones
														</button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenu1">
															@if($revision->estado <> 'C')
																<a data-toggle="modal" data-target="#modalConfirmar"
																   class="dropdown-item" href="#"
																   id="btn_motivo_rechazo" data-id="{{$revision->id}}">Rechazar
																</a>
															@endif
															@if($revision->estado == 'R')
																<a class="dropdown-item"
																   href="{{route('media.administracion.revisiones.aforo.guardarComentario',
																   [
																   'estado'=>'A',
																   'comentario'=>'',
																   'id'=>$revision->id
																   ])}}">
																	Aceptar aforo
																</a>
															@endif
															<a class="dropdown-item" href="{{route('media.administracion.revisiones.aforo.imprimir', ['subsistema_id'=>$revision->revision->subsistema_id,'formato'=>2])}}" id="btn_imprimir" data-id="{{$revision->subsistema_id}}">Descargar
																CSV</a>
														</div>
													</div>
												</td>
											</tr>
										@else
											<tr>
												<td>{{$loop->iteration}}</td>
												<td>{{$revision->subsistema->referencia}}</td>
												<td>{{Jenssegers\Date\Date::parse($revision->review->fecha_apertura)->format('j \\d\\e F Y')}}</td>
												<td>{{$revision->review->usuarioApertura->nombre.' '.$revision->review->usuarioApertura->primer_apellido.' '.$revision->review->usuarioApertura->segundo_apellido}}</td>
												@if($revision->review->estado == 'A')
													<td>{{'Aceptado'}}</td>
												@elseif($revision->review->estado == 'R')
													<td>{{'En revisión'}}</td>
												@elseif($revision->review->estado = 'C')
													<td>{{'Cancelado'}}</td>
												@endif
												@if(!empty($revision->review->usuario_revision))
													<td>{{$revision->review->usuarioRevision->nombre.' '.$revision->review->usuarioRevision->primer_apellido.' '.$revision->review->usuarioRevision->segundo_apellido}}</td>
												@else
													<td></td>
												@endif
												<td>
													<div class="dropdown">
														<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															Opciones
														</button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenu1">
															@if($revision->review->estado <> 'C')
																<a data-toggle="modal" data-target="#modalConfirmar"
																   class="dropdown-item" href="#"
																   id="btn_motivo_rechazo" data-id="{{$revision->review->id}}">Rechazar
																</a>
															@endif
															@if($revision->review->estado == 'R')
																<a class="dropdown-item"
																   href="{{route('media.administracion.revisiones.aforo.guardarComentario',
																   [
																   'estado'=>'A',
																   'comentario'=>'',
																   'id'=>$revision->review->id
																   ])}}">
																	Aceptar aforo
																</a>
															@endif
															<a class="dropdown-item" href="{{route('media.administracion.revisiones.aforo.imprimir', ['subsistema_id'=>$revision->subsistema_id,'formato'=>2])}}" id="btn_imprimir" data-id="{{$revision->subsistema_id}}">Descargar
																CSV</a>
														</div>
													</div>
												</td>
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
	<!-- Modal -->
	<div class="modal fade" id="modalConfirmar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Motivo rechazo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-group">{!! Form::label('observacion','Comentarios:') !!}
							{!! Form::textarea('comentario',NULL,['class'=>'form-control','rows'=>3,'required','id'=>'comentario']) !!}
						</div>
						<div id="mensajeUsuario"></div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<a href="{{  route('media.administracion.revisiones.aforo.guardarComentario') }}" class="btn btn-primary" data-button="btnAceptaConfirmacion">Aceptar</a>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('extra-scripts')
	<script src="{{ mix('js/media/administracion/aforo/index.js') }}"></script>
@endsection