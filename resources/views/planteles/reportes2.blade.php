<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<style>

			body {
				color: #000000 !important;
				width: 100%;
				height: 100%;
			}

			.encabezado {
				font-family: "Trebuchet MS";
				font-weight: bold;
				font-size: 9px;
				letter-spacing: 2px;
				text-align: center;

			}

			.table {
				border-collapse: collapse;
				border-spacing: 0;
				margin: auto;
				margin-bottom: 15px;
			}

			.table td {
				font-family: "Trebuchet MS";
				font-weight: bold;
				font-size: 8px;
				padding: 5px 5px;
				border-style: solid;
				border-width: 1px;
				overflow: hidden;
				word-break: normal;
				border-color: black;
			}

			.table th {
				font-family: "Trebuchet MS";
				font-weight: bold;
				font-size: 8px;
				background-color: lightgray;
				padding: 5px 5px;
				border-style: solid;
				border-width: 1px;
				overflow: hidden;
				word-break: normal;
				border-color: black;
			}

			.table_aspirantes {
				border-collapse: collapse;
				border-spacing: 0;
				margin: auto;
				margin-bottom: 15px;
			}

			.table_aspirantes td {
				font-family: "Trebuchet MS";
				font-weight: normal;
				font-size: 8px;
				padding: 15px 15px;
				overflow: hidden;
				word-break: normal;
			}

			.table_aspirantes th {
				font-family: "Trebuchet MS";
				font-weight: normal;
				font-size: 8px;
				width: 150px;
				background-color: lightgray;
				padding: 5px 5px;
				border-style: solid;
				border-width: 1px;
				overflow: hidden;
				word-break: normal;
				border-color: black;
			}

			.page1 {
				#overflow: hidden;
				page-break-after: always;
				#position: relative;
			}
		</style>
	</head>
	<body>
		<div class="contenedor">
			@foreach($aulas as $aula)
				<div class="page">
					<div class="encabezado">
						<p>{{$aulas[0]->descripcion}}</p><br>
						<p>ACUSE DE LOS ASPIRANTES QUE PRESENTAN EN ESTA AULA</p>

						<table class="table">
							<colgroup>
								<col style="width: 150px">
								<col style="width: 150px">
								<col style="width: 150px">
								<col style="width: 150px">
							</colgroup>
							<tr>
								<th>AULA</th>
								<th>CAPACIDAD</th>
								<th>LUGARES OCUPADOS</th>
								<th>LUGARES LIBRES</th>
							</tr>
							<tr>
								<td>{{$aula->id}}</td>
								<td>{{$aula->capacidad}}</td>
								<td>{{$aula->lugares_ocupados}} </td>
								<td>{{$aula->capacidad- $aula->lugares_ocupados}}</td>
							</tr>
						</table>
						<table class="table_aspirantes">
							<colgroup>
								<col style="width: 50px">
								<col style="width: 300px">
								<col style="width: 100px">
								<col style="width: 100px">
								<col style="width: 100px">
								<col style="width: 100px">
							</colgroup>
							<tr>
								<th>No. de lista</th>
								<th>Nombre del alumno</th>
								<th>Folio CENEVAL</th>
								<th>Entrada</th>
								<th>Versión de examen</th>
								<th>Observaciónes</th>
							</tr>
							@foreach($query as $aspirante)
								@if($aula->id == $aspirante->no_aula)

									<tr style="border-bottom: 1px solid #C9CDCD;">
										<td>{{$aspirante->numero_lista}}</td>
										<td>{{ $aspirante->nombre_completo }}</td>
										<td>{{$aspirante->folio}}</td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								@endif
							@endforeach
						</table>
						<label>firma del responsable</label>
						<hr style ="margin-top: 38px " color="black" size=0.5 width="300">
					</div>
					@if(!$loop->last)
						<div class="page1"></div>
					@endif
				</div>
			@endforeach
		</div>
	</body>
</html>
