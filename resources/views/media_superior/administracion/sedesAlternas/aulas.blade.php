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
    Educación Media - Administración - Sedes alternas - aulas
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="card-title">Sedes alternas - aulas</div>
                        <a class="btn btn-primary pull-right" title="Nueva aula" href="{{ route('media.administracion.aulas.create',$sedeAlterna->id) }}">Agregar</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Referencia</th>
                                    <th>Capacidad</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($aulas as $aula)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $aula->referencia }}</td>
                                        <td>{{ $aula->capacidad }}</td>
                                        <td>
                                            <a href="{{ route('media.administracion.aulas.delete', $aula->id) }}">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
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


