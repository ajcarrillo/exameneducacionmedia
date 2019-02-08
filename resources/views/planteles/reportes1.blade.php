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
        h5{
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

        .page {
            overflow: hidden;
            page-break-after: always;
            position:relative;
        }
        .dtll{
            height: 26cm;
        }
        .footer{
            text-align: center;
            font-size: 8px;
            letter-spacing: 2px;
            font-weight: bold;
        }



    </style>

</head>
<body >
<div class="section " style="">

    @foreach($aulas as $aula)

        <div  style="padding: 0.5cm" class="page">
            <div class="dtll" >
                <img
                     src="data:image/png;base64,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"
                     width="20%">

                <div style="text-align:center"  >

                    <h5>SUBSECRETARIA DE EDUCACIÓN MEDIA SUPERIOR<br>
                        DIRECCIÓN DE EDUCACIÓN MEDIA SUPERIOR<br>
                        DEPARTAMENTO DE EDUCACIÓN MEDA SUPERIOR
                    </h5>
                    <h5>{{ $aulas[0]->descripcion }}<br>
                        RELACIÓN DE ASPIRANTES QUE PRESENTAN EN ESTA AULA
                    </h5>
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
                                    <td>{{ $aspirante->especialidad }}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="footer">{{'*** Aspirantes con derecho a presentar examen que no concluyeron su registro en línea en el plazo especificado.'}} <br>{{Carbon::now()->toFormattedDateString()}}</div>

        </div>


    @endforeach

</div>




</body>
</html>

