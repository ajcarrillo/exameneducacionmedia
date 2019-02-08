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
	Aspirante - Capturar cuestionario ceneval
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@include('flash::message')
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				{!! Form::open(['class'=>'', 'method'=>'post', 'route'=>['guarda.cuestionario'], 'name'=>'form-cuestionario', 'id' => 'form-cuestionario']) !!}
				<div class="card card-primary card-outline">
					<div class="card-header">
						<div class="card-title">CAPTURAR CUESTIONARIO CENEVAL</div>
					</div>
					<div class="card-body">
						<div id="contenedor">
							<div id="pagina-{{ $page }}">
								<p class="text-center text-info">
									Página <span class="badge badge-light">{{ $page }}</span>
								</p>
								@foreach($preguntas as $pregunta)
									<div class="card card-info">
										<div class="card-header">
											{{ $pregunta->nombre }}
										</div>
										<div class="card-body">
											<ul class="list-group">
												@foreach($pregunta->hijos as $hijo)
													<li class="list-group-item list-group-item-action">
														<b>{{ $hijo->nombre }}</b>

														<select name="preguntas[{{ $hijo->id }}]" class="form-control col-sm-6" >
															<option value="">Seleccione...</option>
															@foreach($hijo->diccionario->respuestas  as $respuesta)
																<option value="{{ $respuesta->id }}">{{ $respuesta->etiqueta }}</option>
															@endforeach
														</select>
													</li>
												@endforeach
											</ul>
										</div>
									</div>
								@endforeach
							</div>
						</div>
						<div id="avisoUsuario"></div>
					</div>
					<div class="card-footer">
						<input type="hidden" data-id="page" data-page="{{ $page }}" data-last="{{ $lastPage }}">
						<button type="submit" id="btnGuardar" class="btn btn-success" style="display: none;">Guardar</button>
						<button type="button" id="btnSiguiente" class="btn btn-light">Siguiente <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection

@section('extra-scripts')
	<script src="{{ mix('js/aspirante/cuestionario/form_cuestionario.js') }}"></script>
@endsection