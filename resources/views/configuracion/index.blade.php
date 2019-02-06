@extends('layouts.app')

@section('navbar-title')
	Enlaces
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col">@include('flash::message')</div>
		</div>

		<div class="card border">
			<div class="card-header">
				<h1 class="card-title">Miscelaneos</h1>
			</div>
			<div class="card-body">
				{!! Form::open(['route' => ['configuracion.update'], 'method'=>'POST', 'id'=>'update-form','class'=>'form-horizontal']) !!}

				@forelse($configs as $config)

					<div class="form-group row">

						<?php
						$att = [ 'class' => 'form-control' ];

						if ($config->obligatorio) {
							$att['required'] = 'required';
						}

						?>
						<label class="col-md-4 col-sm-12 col-form-label">{!! $config->descripcion !!}</label>

						<div class="col-md-8 col-sm-12">
							@if(strlen($config->valor) > 100)
								<?php
								$att['rows'] = 3;
								?>
								{!! Form::textarea('configuracion['.$config->id.']', $config->valor, $att) !!}
							@else
								{!! Form::text('configuracion['.$config->id.']', $config->valor, $att) !!}
							@endif
						</div>
					</div>
				@empty
					<p>No hay variables de configuración</p>
				@endforelse

				@if($configs)
					<div class="row">
						<div class="col-sm-12">
							<button id="btnGuardar" type="submit" class="btn btn-success">Guardar</button>
						</div>
					</div>
				@endif

				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection