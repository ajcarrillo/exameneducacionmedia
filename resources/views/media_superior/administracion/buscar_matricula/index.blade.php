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
    Educación Media - Administración - Buscar matrícula
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="card-title">Buscar matrícula</div>
	                    {!! Form::open(['class'=>'', 'route'=>['media.administracion.estudiante.buscar'], 'name'=>'form-buscar', 'id' => 'form-buscar']) !!}
		                    <div class="form-row">
			                    <div class="form-group col-md-6">
				                    <label for="nombreCompleto">Nombre completo</label>
				                    {!! Form::text('nombreCompleto', null, ['class' => 'form-control ', 'id' => 'nombreCompleto', 'placeholder' => 'Puede escribir parte del nombre']) !!}
			                    </div>
			                    <div class="form-group col-md-6">
				                    <label for="curp">Curp</label>
				                    {!! Form::text('curp', null, ['class'=>'form-control ', 'id'=>'curp']) !!}
			                    </div>
		                    </div>
		                    <button id="btnBuscar" type="button" class="btn btn-primary">Buscar</button>
	                    {!! Form::close() !!}
	                    <p class="card-text">
	                        <div id="avisoUsuario" class="alert alert-warning" role="alert" style="display: none"></div>
	                    </p>
                    </div>
                    <div class="card-body">
	                    @if($buscar)
		                    <p class="text-right">
		                        <button type="button" class="btn btn-primary btn-sm">
		                            Resultados <span class="badge badge-light"> {{ count($estudiantes) }} </span>
		                        </button>
		                    </p>
		                    <div class="table-responsive">
			                    <table class="table table-bordered table-striped table-hover">
				                    <thead>
					                    <tr>
						                    <th>#</th>
						                    <th>Nombre completo</th>
						                    <th>Matrícula</th>
						                    <th>Curp</th>
					                    </tr>
				                    </thead>
				                    <tbody>
					                    @forelse($estudiantes as $estudiante)
						                    <tr>
							                    <td>{{ $loop->iteration }}</td>
												<td>{{ $estudiante['nombre_completo'] }}</td>
							                    <td>{{ $estudiante['matricula'] }}</td>
							                    <td>{{ $estudiante['curp'] }}</td>
						                    </tr>
					                    @empty
						                    <div class="alert alert-primary" role="alert">No se encontraron datos.</div>
					                    @endforelse
				                    </tbody>
			                    </table>
		                    </div>
	                    @endif
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
	<script src="{{ mix('js/media/administracion/buscar_matricula/index.js') }}"></script>
@endsection
