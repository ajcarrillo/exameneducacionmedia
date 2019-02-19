<?php
/**
 * Created by PhpStorm.
 * User: igna
 */
?>

<div class="card-body">
	<div class="table-responsive-sm">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Fecha de envío</th>
					<th>Estatus</th>
					<th>Estatus del pago</th>
				</tr>
			</thead>
			<tbody>
				@forelse($revisiones as $revision)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $revision->revision->fecha_apertura }}</td>
						<td>{{ $revision->revision->estado }}</td>
						<td>
							{!! Form::select('revisiones[efectuado]',$estados,$revision->efectuado,['class'=>'form-control']) !!}
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="4" class="text-center">No se encontraron registros</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>
