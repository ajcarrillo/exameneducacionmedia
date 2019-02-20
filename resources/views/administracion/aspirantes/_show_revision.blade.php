<?php
/**
 * Created by PhpStorm.
 * User: igna
 */
?>

<div class="card-body">
	<div class="form-row">
		@if($conRevision and $revision->revision)
			<div class="form-group col-sm-4">
				<label for="">Fecha de envío</label>
				<p class="form-control-plaintext">
					{{ $revision->revision->fecha_apertura }}
				</p>
			</div>
			<div class="form-group col-sm-4">
				<label for="">Estatus</label>
				<p class="form-control-plaintext">
					{{ $revision->revision->estadoTexto }}
				</p>
			</div>
			<div class="form-group col-sm-4">
				{!! Form::label('revisiones[efectuado]', 'Estatus del pago') !!}
				{!! Form::select('revision[efectuado]',$estadosPago,$revision->efectuado,['class'=>'form-control']) !!}
			</div>
		@else
			<p class="form-control-plaintext text-center">No se encontraron registros</p>
		@endif
	</div>
</div>
