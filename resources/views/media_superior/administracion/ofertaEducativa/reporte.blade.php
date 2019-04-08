<?php
/**
 * Created by PhpStorm.
 * User: MPROTO
 * Date: 26/03/2019
 * Time: 08:56 AM
 */

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <style>
        <style>
        body {
            font-family: "Trebuchet MS";
        }

        h5 {
            font-weight: bold;
            font-size: 11px;
            letter-spacing: 2px;
            font-family: "Trebuchet MS";

        }

        .tablegral {
            border-collapse: collapse;
        }

        .tablegral {
            margin: auto;
            font-size: 7px;
            font-family: "Trebuchet MS";
            font-weight: bold;
            letter-spacing: 2px;
        }


        .tablegral, .tablegral th{

            text-align: center;
        }

        .tablegral tr{
            border-bottom: 1px solid lightgrey;
        }
        .tablegral td {
            text-align: justify;
            font-size: 7px;
            padding: 1.5em;
            vertical-align:top;

        }
        .tablegral td a{
            text-decoration:none;
            color:black;
        }

        .tablegral thead .gral th {

            background-color: lightgrey;
            text-align: center;

        }
        .grey{
            background-color: lightgrey;
            text-align: center;
        }

        .tabledetll thead tr th {

            background-color: lightgrey;

        }
        .dtll{
            font-size: 10px;
        }
        .dtll tr th{
            font-weight: bold;
        }
        .page {

            padding: 0;
            page-break-before: always;
            padding-top: 5em;
            size: auto;

        }
        .estadisticas{
            margin-top: -30px;
        }
        #container {
            min-width: 500px;
            max-width: 500px;
            height: 400px;
            margin: 0 auto
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
</head>
<body>
<div class="row justify-content-center">
    <div class="col-10">

    @foreach($datos->groupBy('municipio') as $dato)

    <table class="table tablegral">
        <thead>
        <tr>
            <th colspan="4" style="text-align: justify">{{$dato[0]['municipio']}}</th>
            <th colspan="3" class="grey">OFERTA EDUCATIVA</th>
        </tr>
        <tr class="gral grey">
            <th width="290px">PLANTEL</th>
            <th width="130px">CCT</th>
            <th width="150px">LOCALIDAD</th>
            <th width="290px">ESPECIALIDAD</th>
            <th colspan="1"><i>GRUPOS</i></th>
            <th colspan="1"><i>ALUMNOS<br>GRUPO</i></th>
            <th colspan="1"><i>TOTAL ALUMNOS</i></th>
        </tr>
        </thead>

               @foreach($dato->groupBy('plantel') as $key)


                    @foreach($key->sortBy('id') as $info)

                         @if($loop->index == 0)
                         <tr>
                            <td>{{$info['plantel']}}</td>
                             <td style="text-align: center">{{$info['clave']}}</td>
                             <td style="text-align: center">{{$info['localidad']}}</td>
                             <td>{{$info['especialidad']}}</td>
                             <td>{{$info['grupos']}}</td>
                             <td>{{$info['alumnos']}}</td>
                             <td>{{$info['total']}}</td>
                         </tr>
                         @else
                         <tr>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td>{{$info['especialidad']}}</td>
                             <td>{{$info['grupos']}}</td>
                             <td>{{$info['alumnos']}}</td>
                             <td>{{$info['total']}}</td>
                         </tr>
                         @endif
                    @endforeach

                            <tr>
                                <td colspan="4" style="text-align: right; font-weight: bold">SUBTOTAL:</td>
                                <td style="border-top: 3px solid grey;" >{{collect($key)->sum('grupos')}}</td>
                                <td style="border-top: 3px solid grey">{{collect($key)->sum('alumnos')}}</td>
                                <td style="border-top: 3px solid grey">{{collect($key)->sum('total')}}</td>
                            </tr>


                 @endforeach

            <tr>
                <td colspan="4" style="text-align: right; font-weight: bold">TOTAL:</td>
                <td style="border-top: 3px solid grey;" >{{collect($dato)->sum('grupos')}}</td>
                <td style="border-top: 3px solid grey">{{collect($dato)->sum('alumnos')}}</td>
                <td style="border-top: 3px solid grey">{{collect($dato)->sum('total')}}</td>
            </tr>
        <tbody>

        </tbody>
    </table>
    @endforeach
    </div>
</div>

<div class="page">
    <div class="estadisticas">


        <h5 style="text-align: center">Distribución de estudiantes por municipio</h5>
        <div class="row">
            <div class="col-6">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <table class="table dtll">
                            <thead>
                            <tr>
                                <th>MUNICIPIOS</th>
                                <th>GRUPOS</th>
                                <th>ALUMNOS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datos->groupBy('municipio') as $dato)
                                @php(array_push($graf, ['name' =>$dato->first()['municipio'], 'y' => $dato->sum('alumnos')]))
                                <tr>
                                    <td>{{$dato->first()['municipio']}}</td>
                                    <td style="text-align: center">{{$dato->sum('grupos')}}</td>
                                    <td style="text-align: center">{{$dato->sum('alumnos')}}</td>
                                </tr>
                            @endforeach
                                <tr style="border-top: 2px solid lightslategrey">
                                    <td style="text-align: right; font-weight: bold">TOTAL:</td>
                                    <td style="text-align: center; font-weight: bold">{{$datos->sum('grupos')}}</td>
                                    <td style="text-align: center; font-weight: bold">{{$datos->sum('alumnos')}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-6 align-middle">
                <p></p>
                <div id="container" data-info="{{json_encode($graf)}}"></div>
                <p id="prb"></p>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-git.min.js"></script>
<script>
    var datos = $('#container').data('info');
    var info = "";
    //$('#prb').html(datos);
    /*datos.forEach( function(valor, indice, array) {
        //info = info + "En el índice " + indice + " hay este valor: " + valor.id;
        info = info + valor.municipio +  "<br>";
    });*/


    $('#prb').html(datos);

    Highcharts.chart('container', {

        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },

        title: {
            text: 'ESTADISTICA GENERAL'
        },

        /*subtitle: {
            text: 'Estadistica Generales'
        },*/

        yAxis: {
            title: {
                text: 'Number of Employees'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            /*pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            },*/
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: 2010,
                animation: false
            }
        },

        series: [{
            name: 'Installation',
            data: this.datos,
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 100
                },
                chartOptions: {
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'bottom',

                    }
                }
            }]
        },
        exporting: {
            enabled: false
        },
        credits: {
            enabled: false
        },

    });
</script>
</body>
</html>
