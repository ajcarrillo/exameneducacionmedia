<?php
/**
 * Created by PhpStorm.
 * User: igna
 */
?>

@extends('aspirante.layouts.aspirante')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center py-3">
            <div class="col">
                @include('aspirante.partials.back_button')
            </div>
        </div>
		<div class="row">
			<div class="col-sm-12">
				<div class="card card-primary card-outline">
					<div class="card-header">
                        <div class="card-title">CUESTIONARIO CENEVAL</div>
					</div>
					<div class="card-body">
						<div class="alert alert-primary"> {{ $_REQUEST['aviso'] }} </div>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection
