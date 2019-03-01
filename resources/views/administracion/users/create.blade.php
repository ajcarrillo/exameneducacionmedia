@extends('layouts.app')

@section('navbar-title')
    Usuarios - nuevo usuario
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col col-md-6">@include('flash::message')</div>
        </div>
        <div class="row justify-content-center">
            <div class="col col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Nuevo usuario</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('media.administracion.usuarios.store') }}" method="post">
                            @csrf
                            @include('administracion.users._user_form')
                            <div class="form-group">
                                <button class="btn btn-success">Guardar</button>
                                <a href="{{ route('media.administracion.usuarios.index') }}" class="btn btn-default">Regresar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
