<?php
/**
 * Created by PhpStorm.
 * User: igna
 */
?>

@extends('layouts.app')

@section('extra-head')
@endsection

@section('navbar-title')
    Educación Media - Administración - Sedes alternas
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="card-title">Sedes alternas</div>
                        <a class="btn btn-primary pull-right" title="Nueva sede alterna" href="{{ route('media.administracion.sedesAlternas.create') }}">Agregar</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre de la sede</th>
                                    <th>Plantel</th>
                                    <th>Municipio</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sedes as $sede)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sede->descripcion }}</td>
                                        <td>{{ $sede->plantel }}</td>
                                        <td>{{ $sede->NOM_MUN }} </td>
                                        <td>
                                            <a href="{{ route('media.administracion.sedesAlternas.edit', $sede->id) }}">
                                                <i class="far fa-edit mr-1"></i>
                                            </a>
                                            <a href="{{ route('media.administracion.sedesAlternas.aulas', $sede->id) }}">
                                                <i class="fas fa-list mr-1"></i>
                                            </a>



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
@endsection


