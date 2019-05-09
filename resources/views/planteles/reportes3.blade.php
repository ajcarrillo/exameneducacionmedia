<?php

use Carbon\Carbon;

?>
	<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<style>
			body {
				font-family: "Trebuchet MS";
			}

			h5 {
				font-weight: bold;
				font-size: 9px;
				letter-spacing: 2px;

			}

			.tablegral, .tabledetll {
				border-collapse: collapse;
			}

			.tablegral, .tabledetll {
				margin: auto;
				font-size: 9px;
				font-family: "Trebuchet MS";
				font-weight: bold;
				letter-spacing: 2px;
			}

			.tabledetll tr td {
				border-bottom: 1px solid lightgrey;
				text-align: center;
				font-size: 7px;
			}

			.tablegral, .tablegral th, .tablegral td {
				border: 1px solid black;
				text-align: center;
			}

			.tablegral thead .gral th {
				width: 150px;
				background-color: lightgrey;
				text-align: center;

			}

			.tabledetll thead tr th {

				background-color: lightgrey;

			}

			.page1 {
				#overflow: hidden;
				page-break-after: always;
				#position: relative;
			}

			.dtll {
				height: 26cm;
			}

			.footer {
				text-align: center;
				font-size: 8px;
				letter-spacing: 2px;
				font-weight: bold;
			}


		</style>

	</head>
	<body>
		<div class="section " style="margin-top: 100px">

			<div class="page">

				<table class="table table-bordered tabledetll">
					<thead>
						<tr>
							<th style="width: 400px">Nombre del alumno</th>
							<th style="width: 170px">Folio CENEVAL</th>
							<th style="width: 300px">Especialidad</th>
							<th style="width: 300px">Aula</th>
						</tr>
					</thead>
					<tbody>

						@foreach($query as $aspirante)
							<tr>
								<td style="text-align: left">{{ $aspirante->nombre_completo }}</td>
								<td>{{ $aspirante->folio_ceneval }}</td>
								<td>{{ $aspirante->especialidad }}</td>
								<td>{{ $aspirante->aula_descripcion }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>

				<div class="page1"></div>

			</div>

		</div>


	</body>
</html>