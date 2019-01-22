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
    Educación Media - Administración - Etapas del proceso
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="card-title">Etapas del proceso</div>
                        <a class="btn btn-primary pull-right" title="Editar" href="{{ route('media.administracion.etapasProceso.edit') }}">Editar</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Etapa</th>
                                    <th>Descripción</th>
                                    <th>Apertura</th>
                                    <th>Cierre</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($etapas as $etapa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $etapa->nombre }}</td>
                                        <td>{{ $etapa->descripcion }}</td>
                                        <td>{{ \Carbon\Carbon::parse($etapa->apertura)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($etapa->cierre)->format('d/m/Y') }}</td>
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


