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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <style>
        body {
            font-family: "Trebuchet MS";
        }

        h5 {
            font-weight: bold;
            font-size: 15px;
            letter-spacing: 2px;

        }

        .tablegral {
            border-collapse: collapse;
        }

        .tablegral {
            margin: auto;
            font-size: 11px;
            font-family: "Trebuchet MS";
            font-weight: bold;
            letter-spacing: 2px;
        }
        .tablegral tr{
            border-bottom: 1px solid lightgrey;
        }
        .tablegral td {
            text-align: justify;
            font-size: 8px;
            padding: 1.5em;
            vertical-align:top;

        }
        .tablegral td a{
            text-decoration:none;
            color:black;
        }

        .tablegral .gral td {

            background-color: lightgrey;
            font-size: 7px;
            text-align: left;
            height: 10px;

        }

        .tabledetll thead tr th {

            background-color: lightgrey;

        }
        .info td{
            font-size: 7px;
        }
        .page {
            page-break-before: always;
        }
    </style>
</head>
<body>
<div class="section">
        @foreach($datos as $dt)
            <table class="table table-bordered tablegral">
            <tr>
                <td colspan="4">
                    <p style="font-size: 12px; text-align: center">{{$dt->first()->subsistema}} ( {{$dt->first()->subsistema_desc}} )</p>
                </td>
            </tr>
            <tr class="gral" >
                <td colspan="1" style="background-color: lightgrey; font-weight: bold">
                    {{$dt->first()->nombre_municipio}}
                </td>
            </tr>
            <tr class="gral">
                <td width="250px">PLANTEL</td>
                <td width="250px">ESPECIALIDAD</td>
                <td style="text-align: center">TOTAL REGISTROS CONCLUIDO</td>
                <td style="text-align: center">TOTAL ASPIRANTES</td>
            </tr>

                @foreach($dt as $info)

                        <tr class="info">
                            <td >{{$info->descripcion}}</td>
                            <td>{{$info->referencia}}</td>
                            <td style="text-align: center">{{$info->concluidos}}</td>
                            <td style="text-align: center">{{$info->seleccion}}</td>
                        </tr>
                        @if($loop->last)
                            @php(array_push($graf, ['name' =>$info->nombre_municipio, 'y' => $dt->sum('seleccion')]))
                            <tr>
                                <td colspan="2" style="text-align: right">Total:</td>
                                <td style="text-align: center; border-top: 2px solid black">{{$dt->sum('concluidos')}}</td>
                                <td style="text-align: center; border-top: 2px solid black">{{$dt->sum('seleccion')}}</td>
                            </tr>
                        @endif
                @endforeach
            </table>
            <div class="page"></div>
        @endforeach
    <table>
        <tr>
            <td>
                <div id="container" data-info="{{json_encode($graf)}}" style="width: 400px"></div>
            </td>
            <td width="300px">
                @php($tot = collect($graf))
                <div style="background-color: lightgrey;text-align: center">
                    TOTAL GENERAL DE ASPIRANTES:<br><b>{{$tot->sum('y')}}</b>
                </div>
            </td>
        </tr>
    </table>
</div>

<script src="https://code.jquery.com/jquery-git.min.js"></script>
<script>
    var datos = $('#container').data('info');
    var info = "";
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
