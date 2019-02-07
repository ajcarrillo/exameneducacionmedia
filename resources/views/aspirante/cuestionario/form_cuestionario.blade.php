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
				{!! Form::open(['class'=>'', 'method'=>'post', 'route'=>['guarda.cuestionario'], 'name'=>'form-cuestionario', 'id' => 'form-cuestionario']) !!}
				<div class="card card-primary card-outline">
					<div class="card-header">
						<div class="card-title">CAPTURAR CUESTIONARIO</div>
					</div>
					<div id="contenedor">

						<div class="card-body">
							@foreach($preguntas as $pregunta)
								<div class="card card-info">
									<div class="card-header">
										{{ $page}} {{ $pregunta->nombre }}
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
						</div>
						<div class="card-footer">
							{{ $preguntas->links() }}
						</div>

					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection

@section('extra-scripts')
	<script>
        $(document).ready(function() {
	        $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();

                var page = $(this).attr('href').split('page=')[1],
                    contenedor = $("#contenedor");

                $.ajax({
                    url: "/aspirantes/captura-cuestionario",
                    type: 'GET',
                    dataType: "json",
                    data: {'page': page},
                })
                    .done(function (response) {
						$("#contenedor").html(response);
                    })
                    .fail(function (xhr) {
                        console.error("Error durante petición ajax.");
                        console.error(xhr);
                    });

            });
        });

	</script>
@endsection