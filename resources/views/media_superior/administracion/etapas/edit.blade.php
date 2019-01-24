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
                @include('flash::message')
            </div>
        </div>
        <div id="avisoUsuario" class="alert alert-warning" role="alert" style="display: none"></div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="card-title">Configuración de etapas del proceso</div>
                    </div>
                    {!! Form::open(['class'=>'', 'route'=>['media.administracion.etapasProceso.update'], 'name'=>'form-etapas', 'id'=>'form-etapas']) !!}
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
                                            <td>
                                                {{ $etapa->descripcion }}
                                                <input type="hidden" name="{{ $etapa->nombre . '[id]' }}" value="{{ $etapa->id }}">
                                            </td>
                                            <td>
                                                <input type="date" id="{{ $etapa->nombre . '-apertura'}}" name="{{ $etapa->nombre . '[apertura]' }}" value="{{ $etapa->apertura }}" class="form-control" title="Apertura" required>
                                            </td>
                                            <td>
                                                <input type="date" id="{{ $etapa->nombre . '-cierre'}}" name="{{ $etapa->nombre . '[cierre]' }}" value="{{ $etapa->cierre }}" class="form-control" title="Cierre" required>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="btnGuardar" type="button" class="btn btn-success">Guardar</button>
                            <a href="{{ route('media.administracion.etapasProceso.index') }}" class="btn btn-default float-right" title="Regresar">Cancelar</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="{{ mix('js/media/administracion/etapas/edit.js') }}"></script>
@endsection

