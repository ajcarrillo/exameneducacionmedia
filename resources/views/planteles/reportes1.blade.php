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
				font-size: 8px;
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
				height: 25cm;
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

			@foreach($aulas as $aula)
				<div class="page">

                    <div style="text-align: center;" >
                        <h5>{{ $aulas[0]->descripcion }}<br>
                            RELACIÓN DE ASPIRANTES QUE PRESENTAN EN ESTA AULA
                        </h5>
                    </div>

							<table class="table table-bordered tablegral">
								<thead>

									<tr class="gral">
										<th>Aula</th>
										<th>Capacidad</th>
										<th>Lugares ocupados</th>
										<th>Lugares libres</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>{{$aula->id}}</td>
										<td>{{$aula->capacidad}}</td>
										<td>{{$aula->lugares_ocupados}}</td>
										<td>{{$aula->capacidad - $aula->lugares_ocupados  }}</td>
									</tr>
								</tbody>
							</table>

							<br>

							<table class="table table-bordered tabledetll">
								<thead>
								<tr>
									<th colspan="4" style="text-align: justify; background-color: white;"><h2>Aula: {{$aula->id}}</h2></th>
								</tr>
									<tr>
										<th style="width: 100px;">No. de Lista</th>
										<th style="width: 400px">Nombre del alumno</th>
										<th style="width: 170px">Folio CENEVAL</th>
										<th style="width: 300px">Especialidad</th>
									</tr>
								</thead>
								<tbody>

									@foreach($query as $aspirante)
										@if($aula->id == $aspirante->no_aula)

											<tr>
												<td>{{$aspirante->numero_lista}}</td>
												<td>{{ $aspirante->nombre_completo }}</td>
												<td>{{ $aspirante->folio_ceneval }}</td>
												<td style="text-align: justify">{{ $aspirante->especialidad }}</td>
											</tr>
										@endif
									@endforeach
								</tbody>
							</table>

				</div>
				@if(!$loop->last)
				<div class="page1"></div>
				@endif
			@endforeach

		</div>


	</body>
</html>

