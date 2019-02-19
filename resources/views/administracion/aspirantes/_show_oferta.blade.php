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
					<th>Plantel</th>
					<th>Especialidad</th>
					<th>Preferencia</th>
				</tr>
			</thead>
			<tbody>
				@forelse($ofertas as $oferta)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $oferta->seleccionOferta->plantel->descripcion }}</td>
						<td>{{ $oferta->seleccionOferta->especialidad->referencia }}</td>
						<td>{{ $oferta->preferencia }}</td>
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
