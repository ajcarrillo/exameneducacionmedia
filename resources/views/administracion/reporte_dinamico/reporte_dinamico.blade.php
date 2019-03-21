@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">

            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="" method="post">
                    @csrf
                    <div class="form-group">
                        @include('administracion.reporte_dinamico._user_fields')
                    </div>
                    <div class="form-group">
                        @include('administracion.reporte_dinamico._aspirante_fields')
                    </div>
                    <div class="form-group">
                        @include('administracion.reporte_dinamico._preferencia_fields')
                    </div>
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input type="checkbox"
                                   name="domicilio"
                                   id="domicilio"
                                   value="1"
                                {{ request('domicilio') ? 'checked': '' }}>
                            Incluir domicilio
                        </label>
                    </div>
                    {{--TODRES: Validar que exista asiganción y mostrar el control--}}
                    {{--<div class="form-group">
                        <label class="checkbox-inline">
                            <input type="checkbox"
                                   name="asignacion"
                                   id="asignacion"
                                   value="1"
                                {{ request('asignacion') ? 'checked': '' }}>
                            Incluir asignación
                        </label>
                    </div>--}}
                    <div class="form-group">
                        <button class="btn btn-success">Generar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

