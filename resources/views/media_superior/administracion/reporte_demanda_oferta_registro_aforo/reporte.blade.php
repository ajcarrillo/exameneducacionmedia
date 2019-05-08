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
            font-size: 8px;
            text-align: left;
            height: 25px;

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


    </style>
</head>
<body>

<div class="section " >

    <div style="padding: 0.5cm" class="page">
        <div class="dtll">

                <table class="table table-bordered tablegral">
                    <thead>
                    <tr class="gral">
                        <th  width="150px">MUNICIPIO</th>
                        <th  width="400px">SUBSISTEMA</th>
                        <th  >REGISTRO</th>
                        <th  >OFERTA</th>
                        <th  >DEMANDA</th>
                        <th  width="80px">POR PAGAR</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($groups as $datos)
                        @foreach($datos->groupBy('subsistema_id') as $dt)
                            @foreach($dt as $info)
                               @if($loop->first)
                                  <tr>
                                     <td >{{$info->nombre_municipio}}</td>
                                     <td colspan="5" style="background-color: lightgrey;">
                                       {{$info->subsistema}}
                                     </td>
                                  </tr>
                               @endif
                               <tr>
                                  <td ></td>
                                  <td >{{$info->descripcion}}</td>
                                  <td style="text-align: center" >{{$info->pases_examen}}</td>
                                  <td style="text-align: center">{{$info->oferta}}</td>
                                  <td style="text-align: center">{{$info->demanda}}</td>
                                  <td style="text-align: center">{{$info->por_pagar}}</td>
                               </tr>
                               @if($loop->last)
                                   <tr>
                                       <td colspan="2" style="text-align: right">
                                           <b>TOTAL SUBSISTEMA</b>
                                       </td>
                                       <td style="border-top: 2px solid black;text-align: center">{{$dt->sum('pases_examen')}}</td>
                                       <td style="border-top: 2px solid black;text-align: center">{{$dt->sum('oferta')}}</td>
                                       <td style="border-top: 2px solid black;text-align: center">{{$dt->sum('demanda')}}</td>
                                       <td style="border-top: 2px solid black;text-align: center">{{$dt->sum('por_pagar')}}</td>
                                   </tr>
                               @endif
                        @endforeach
                        @endforeach
                        <tr>
                            <td colspan="2" style="text-align: right">
                                <b>TOTAL MUNICIPIO</b>
                            </td>
                            <td style="border-top: 2px solid black;text-align: center">{{$datos->sum('pases_examen')}}</td>
                            <td style="border-top: 2px solid black;text-align: center">{{$datos->sum('oferta')}}</td>
                            <td style="border-top: 2px solid black;text-align: center">{{$datos->sum('demanda')}}</td>
                            <td style="border-top: 2px solid black;text-align: center">{{$datos->sum('por_pagar')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>

    </div>
</div>
</body>
</html>
