@extends('layouts.app')

@section('navbar-title')
    Sedes alternas - Nuevo
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">@include('flash::message')</div>
        </div>
        <div class="row justify-content-center">
            <div class="col col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Crear nuevo enlace</h1>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route'=>['media.administracion.sedesAlternas.store'], 'method'=>'post']) !!}
                        @include('media_superior.administracion.sedesAlternas._sede_form')
                        <div class="form-group">
                            <button class="btn btn-success" name="save">Guardar</button>
                            <button class="btn btn-success" name="addanother">Guardar y agregar otro</button>
                            <a href="{{ route('media.administracion.sedesAlternas.index') }}" class="btn btn-default">Regresar</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="{{ mix('js/media/administracion/sedes_alternas/create.js') }}"></script>
@endsection
