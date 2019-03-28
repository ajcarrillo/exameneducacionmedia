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
            font-size: 9px;
            letter-spacing: 2px;

        }

        .tablegral {
            border-collapse: collapse;
        }

        .tablegral {
            margin: auto;
            font-size: 9px;
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
    @foreach($mpios as $mpio)
    <div style="padding: 0.5cm" class="page">
        <div class="dtll">
            <div style="text-align:center;">


                    <div style="text-align: left"><b>{{$mpio->NOM_MUN}}</b></div>
                    <table class="table table-bordered tablegral">
                        <thead>
                        <tr class="gral">
                            <th width="300px">PLANTEL</th>
                            <th width="250px">ESPECIALIDAD</th>
                            <th width="250px">DOMICILIO</th>

                            <th width="150px">PAGINA WEB</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datos as $dato)
                            @if($dato->cve_mun == $mpio->CVE_MUN)

                                <tr>
                                    <td>{{$dato->plantel}}</td>
                                    <td>{{$dato->especialidad}}</td>
                                    <td>{{$dato->domicilio}}</td>

                                    <td><a href="{{$dato->pagina_web}}">{{$dato->pagina_web}}</a></td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>

    </div>

    @endforeach
</div>
</body>
</html>
