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

														<select name="preguntas[{{ $hijo->id }}]"
														        class="form-control col-sm-6">
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
					</div>
					<div class="card-footer">
						<input type="hidden" data-id="page" data-page="{{ $page }}" data-last="{{ $lastPage }}">
						<button type="submit" id="btnGuardar" class="btn btn-success" style="display: none;">Guardar
						</button>
						<button type="button" id="btnSiguiente" class="btn btn-default">Siguiente <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection

@section('extra-scripts')
	<script>
		$(document).ready(function () {
			"use strict";

			$("#btnSiguiente").on("click", function () {
				var idPage = $('[data-id="page"]'),
					page = idPage.attr("data-page"),
					siguiente = parseInt(page) + 1,
					lastPage = idPage.attr("data-last"),
					boton = $("#btnGuardar"),
					contenedor = $("#contenedor");

				if (siguiente > lastPage) {
					return false;
				}

				$.ajax({
					url: "/aspirantes/captura-cuestionario",
					type: 'GET',
					dataType: "json",
					data: {'page': siguiente}
				})
					.done(function (response) {
						$("[id*='pagina-']").css("display", "none");
						idPage.attr("data-page", siguiente);
						contenedor.append(response);

						if (siguiente == lastPage) {
							boton.css("display", "block");
							$("#btnSiguiente").css("display", "none");
						}
					})
					.fail(function (xhr) {
						console.error("Error durante petición ajax.");
						console.error(xhr);
					});
			});
		});
	</script>
@endsection