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
	Educación Media - Administración - Actualizar Responsable
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@include('flash::message')
			</div>
		</div>
		<div id="avisoUsuario" class="alert alert-warning" role="alert" style="display: none"></div>
		<div class="row">
			<div class="col-sm-12">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<div class="card-title">Actualizar responsable</div>
					</div>
					<div class="card-body">
						{!! Form::model( $responsable,['class'=>'form-horizontal','route'=>['media.administracion.responsablePlantel.plantel.set_responsable',$responsable]]) !!}
						<div class="row">
							<div class="col form-group">
								{!! Form::label('nombre', 'Nombre(s):', ['class'=>'control-label']) !!}
								<div class="">
									{!! Form::text('nombre', $responsable->responsable->nombre, ['class'=>'form-control', 'required']) !!}
								</div>
							</div>
							<div class="col form-group">
								{!! Form::label('apellidos', 'Primer Apellido :', ['class'=>'control-label']) !!}
								<div class="">
									{!! Form::text('primer_apellido',$responsable->responsable->primer_apellido, ['class'=>'form-control', 'required']) !!}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col form-group">
								{!! Form::label('apellidos', 'Segundo Apellido :', ['class'=>'control-label']) !!}
								<div class="">
									{!! Form::text('segundo_apellido',$responsable->responsable->segundo_apellido, ['class'=>'form-control', 'required']) !!}
								</div>
							</div>
							<div class="col form-group">
								{!! Form::label('email', 'Correo electrónico:', ['class'=>'control-label']) !!}
								<div class="">
									{!! Form::email('email', $responsable->responsable->email, ['class'=>'form-control', 'required']) !!}
								</div>
							</div>
						</div>
						<div class="form-group row">
							{!! Form::label('username', 'Usuario:', ['class'=>'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::text('username', $responsable->responsable->username, ['class'=>'form-control', 'required']) !!}
							</div>
						</div>
						<div class="form-group row">
							{!! Form::label('password', 'Contraseña:', ['class'=>'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::password('password',['class'=>'form-control', 'required']) !!}
							</div>
						</div>
					</div>
					<div class="card-footer">
						<button type="submit" class="btn btn-primary">Actualizar</button>
						<a href="{{route('media.administracion.responsablePlantel.index')}}" class="btn btn-default float-right" title="Regresar">Cancelar</a>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection


