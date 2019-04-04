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
            font-size: 9px;
            letter-spacing: 2px;

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
    </style>
</head>
<body>
<div class="section " >

    @foreach($datos->groupBy('municipio') as $dato)

    <table class="table table-bordered tablegral">
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
</body>
</html>
