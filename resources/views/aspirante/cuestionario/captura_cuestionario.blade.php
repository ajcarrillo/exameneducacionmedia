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
Aspirante - Capturar cuestionario
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<div class="card-title">CAPTURAR CUESTIONARIO</div>
					</div>
					<div class="card-body">
						{!! Form::open(['class'=>'', 'method'=>'post', 'name'=>'form-cuestionario', 'id' => 'form-cuestionario']) !!}
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

													<select name="respuesta" id="" class="form-control col-md-6" required>
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
						{!! Form::close() !!}
					</div>
					<div class="card-footer">
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('extra-scripts')
@endsection