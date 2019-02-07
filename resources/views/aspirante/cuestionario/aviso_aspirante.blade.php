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
			<div class="col-md-12">
				<div class="alert alert-primary" role="alert">
					{{ $aviso }}
				</div>
			</div>
		</div>
	</div>
@endsection
