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


        .tablegral, .tablegral th{

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

        .tablegral thead .gral th {

            background-color: lightgrey;

        }

        .tabledetll thead tr th {

            background-color: lightgrey;

        }

        .page {

            margin: 0;
            padding: 0;
            page-break-before: always;
            padding-top: 5em;
            size: auto;

        }

        .dtll {
            #height: 18.35cm;
        }

        .footer {
            text-align: center;
            font-size: 8px;
            letter-spacing: 2px;
            font-weight: bold;
        }

        #top {
            position:fixed;
            top:0px;
            width:100%;
            height:70px;
        }


    </style>

</head>
<body>
<div class="section " >

    <div style="padding: 0.5cm" class="page">
        <div class="dtll">
            <div style="">


                    <div style="text-align: left"><b></b></div>
                    <table class="table table-bordered tablegral">
                        <thead>
                        <tr class="gral">
                            <th style="text-align: left!important;" width="150px">SUBSISTEMA</th>
                            <th style="text-align: right!important;" width="100px">REGISTRO</th>
                            <th style="text-align: right!important;" width="80px">AFORO</th>
                            <th style="text-align: right!important;" width="80px">DEMANDA</th>
                            <th style="text-align: right!important;" width="150px">SIN PASE</th>
                            <th style="text-align: right!important;" width="100px">SIN PAGO</th>
                            <th style="text-align: right!important;" width="150px">OFERTA EDUCATIVA</th>
                            <th style="text-align: right!important;" width="70px">% OFERTA</th>
                            <th style="text-align: right!important;" width="70px">% AFORO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($query as $datos)
                            <tr>
                                <td class="text-left">{{$datos->subsistema}}</td>
                                <td style="text-align: right!important;">{{$datos->proceso_completo}}</td>
                                <td style="text-align: right!important;">{{$datos->aforo}}</td>
                                <td style="text-align: right!important;">{{$datos->demanda}}</td>
                                <td style="text-align: right!important;">{{$datos->sin_pase}}</td>
                                <td style="text-align: right!important;">{{$datos->con_registro_sin_pago}}</td>
                                <td style="text-align: right!important;">{{$datos->oferta}}</td>
                                <td style="text-align: right!important;">{{ round(($datos->demanda * 100)/ $datos->oferta) }}</td>
                                <td style="text-align: right!important;">{{ round(($datos->proceso_completo * 100)/ $datos->aforo) }}</td>
                            </tr>

                        @endforeach
                        <tr style="border-top: 2px solid lightslategrey">
                            <td style="text-align: right!important;"><b>TOTAL</b></td>
                            <td style="text-align: right!important;">{{$query->sum('proceso_completo')}}</td>
                            <td style="text-align: right!important;">{{$query->sum('aforo')}}</td>
                            <td style="text-align: right!important;">{{$query->sum('demanda')}}</td>
                            <td style="text-align: right!important;">{{$query->sum('sin_pase')}}</td>
                            <td style="text-align: right!important;">{{$query->sum('con_registro_sin_pago')}}</td>
                            <td style="text-align: right!important;">{{$query->sum('oferta')}}</td>
                        </tr>
                        </tbody>
                    </table>
            </div>
        </div>

    </div>


</div>
</body>
</html>
