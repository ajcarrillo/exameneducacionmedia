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
						<div class="card-title">Capturar cuestionario</div>
					</div>
					<div class="card-body">
						{!! Form::open(['class'=>'', 'method'=>'post', 'name'=>'form-cuestionario', 'id' => 'form-cuestionario']) !!}
							@foreach($preguntas as $pregunta)
								<div class="card card-info">
									<div class="card-header">
										{{ $pregunta->nombre }}
									</div>
									<ul class="list-group">
										@foreach($pregunta->hijos as $hijo)
											<li class="list-group-item list-group-item-action">
												{{ $hijo->nombre }}
											</li>
										@endforeach
									</ul>
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