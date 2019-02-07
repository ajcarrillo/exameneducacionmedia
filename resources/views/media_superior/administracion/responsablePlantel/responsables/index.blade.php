<?php
/**
 * Created by PhpStorm.
 * User: igna
 */
?>

@extends('layouts.app')

@section('extra-head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('navbar-title')
    Educación Media - Administración - Responsables planteles
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('flash::message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="card-title">Listado de planteles</div>
                    </div>

                    <div class="card-body">

                        <table class="table table-bordered table-striped table-hover" id="filtro">
                            <thead>
                            <tr valign="top">
                                <th>#</th>
                                <th style="vertical-align:top;">Clave</th>
                                <th style="vertical-align:top;">Descripción</th>
                                <th style="vertical-align:top;">Responsable</th>
                                <th>Subsistema</th>
                                <th>Descuento</th>
                                <th>No. Opciones</th>
                                <th style="vertical-align:top;">opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($planteles as $plantel)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $plantel->clave }}</td>
                                    <td>{{ $plantel->descripcion }}</td>
                                    <td>
                                        @if(isset($plantel->responsable))
                                            {!!$plantel->responsable->username.'<br>NOMBRE: '.$plantel->responsable->nombre.' '.
                                            $plantel->responsable->primer_apellido.' '.$plantel->responsable->segundo_apellido!!}
                                        @endif
                                    </td>
                                    <td>{{ $plantel->subsistema->referencia }}</td>
                                    <td>{{ $plantel->descuento.'%' }}</td>
                                    <td>{{ $plantel->opciones }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                                Acciones
                                                <span class="caret"></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <a class="dropdown-item" href="{{route('media.administracion.responsablePlantel.plantel.edit',$plantel) }}">Actualizar responsable</a>
                                                <a class="dropdown-item" href="{{route('media.administracion.responsablePlantel.plantel.descuentos',$plantel)}}"> Descuentos / Opc. Educativas</a>
                                            </div>
                                        </div>


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="{{ asset('datatables/datatables.js') }}"></script>
    <script src="{{mix('js/media/administracion/responsable_plantel/eliminar.js')}}"></script>
@endsection


