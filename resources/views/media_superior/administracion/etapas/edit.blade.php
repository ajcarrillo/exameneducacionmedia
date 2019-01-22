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
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="card-title">Editar etapas del proceso</div>
                    </div>
                    {!! Form::open(['class'=>'', 'route'=>['media.administracion.etapasProceso.update'], 'name'=>'form-etapas']) !!}
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
                                                <input type="hidden" class="form-control" name="{{ $etapa->nombre . '[id]' }}" value="{{ $etapa->id }}">
                                                <input type="text" class="form-control" name="{{ $etapa->nombre . '[descripcion]' }}" value="{{ $etapa->descripcion }}" title="Descripcion" required>
                                            </td>
                                            <td>
                                                <input type="date" class="form-control" name="{{ $etapa->nombre . '[apertura]' }}" value="{{ $etapa->apertura }}" title="Apertura" required>
                                            </td>
                                            <td>
                                                <input type="date" class="form-control" name="{{ $etapa->nombre . '[cierre]' }}" value="{{ $etapa->cierre }}" title="Cierre" required>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <a href="{{ route('media.administracion.etapasProceso.index') }}" class="btn btn-default float-right" title="Regresar">Cancelar</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
@endsection

