<?php
/**
 * Created by PhpStorm.
 * User: igna
 */
?>

@extends('layouts.app')

@section('navbar-title')
	Educación Media - Administración - Carga de documentos
@endsection

@section('content')
	<section class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				@if ($errors->any())
					<div class="alert alert-danger alert-dismissable alert-important" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
						Revise los siguientes campos.
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-8" id="messages-controller">
				@include('flash::message')
			</div>
		</div>
		<div class="row  justify-content-center">
			<div class="col-md-8">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">Cargar documento</h3>
					</div>
					<div class="card-body">
						{!! Form::open(['action' => 'Administracion\CargaDocumentosController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
						<div class=" text-center form-group" >
							<img id="pdf_thumbnail" class="img-thumbnail img-responsive rounded" width="15%" height="15%">
						</div>
						<div class="text-center">
							{!! Form::label('image_logo',' Selecciona un documento :',['class'=>'control-label mb-4 font-weight-bold text-info']) !!}
							<br>
								<button  type="button" class="btn btn -lg btn-primary mb-4" id="limpiar"><li class="fa fa-eraser"></li> Limpiar</button>
							<br>
							{{Form::file('pdf',['class'=>'form-control font-weight-light','id' =>'pdf','required' =>'true','size'=>'1000'])}}
							<br>
							{!! Form::label('info','Selecciona los roles para los que estará disponible este documento:',['class'=>'control-label mb-4 text-center text-info font-weight-bold font-size-4']) !!}

							<div class="row">
								<div class="form-group col-md-12" style="text-align: center">
								@foreach ($roles as $role)

									<?php
										$nombre='';
									if (!empty($roles[$role->id]))
										$nombre="roles[".$role->id."]";
									?>
									<label  for ="<?=$nombre?>" class="col-md-3">
									    {!! Form::checkbox("roles[$role->id]",$role->id,NULL,['class' =>'font-weight-light','id' =>"cadena_rol_".$role->id ]) !!}
										{!! Form::label('cadena_rol_'.$role->id, $role->name,['class' =>'font-weight-light'])!!}
									</label>
									@endforeach
								</div>
							</div>
							<br>
							<div class="form-group col-12 justify-content-center">
								<label class="text-info">comentario:</label>
								<textarea class="form-control" name="descripcion" rows="1"></textarea>
							</div>
						</div>
						<br>
						<div class="box-body">
							<div class="form-group">
								<span class="badge badge-info">Formato permitido /pdf</span>
								<span class="badge badge-info">Tamaño Máximo 1MB.</span>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<button type="submit" class="btn btn-success">Guardar</button>
						<button type="submit" class="btn btn-success" name="addanother">Guardar y agregar otro</button>
						<a href="{{route('media.administracion.carga-documentos.index')}}" class="btn btn-default float-right">Regresar</a>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</section>
@endsection
@section('extra-scripts')

	<script src="{{ mix('js/media/administracion/carga_documento/create.js') }}"></script>


@endsection



