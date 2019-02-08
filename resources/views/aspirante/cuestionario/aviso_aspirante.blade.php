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
				<div class="card card-primary card-outline">
					<div class="card-header">
						<div class="card-title">CAPTURAR CUESTIONARIO CENEVAL</div>
					</div>
					<div class="card-body">
						<div class="alert alert-primary"> {{ $_REQUEST['aviso'] }} </div>
					</div>
					<div class="card-footer">
						<a type="button" class="btn btn-light" href="{{ route('aspirantes.dashboard') }}">Inicio</a>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection