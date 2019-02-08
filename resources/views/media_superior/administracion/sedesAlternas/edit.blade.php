@extends('layouts.app')

@section('extra-head')
    <link href="/select2/dist/css/select2.css" rel="stylesheet" />
    <link href="/select2-bootstrap4-theme/dist/select2-bootstrap4.css" rel="stylesheet" />
@endsection

@section('navbar-title')
    Sedes alternas - Editar
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">@include('flash::message')</div>
        </div>
        <div class="row justify-content-center">
            <div class="col col-md-8 col-lg-6">
                <div class="card shadow-none border">
                    <div class="card-header">
                        <h1 class="card-title">Editar enlace</h1>
                    </div>
                    <div class="card-body">
                        {!! Form::model($sedeAlterna, ['route'=>['media.administracion.sedesAlternas.update', $sedeAlterna->id], 'method'=>'patch']) !!}
                        <div class="form-group">
                            {!! Form::label('descripcion', 'Descripción', ['class'=>'control-label']) !!}
                            {!! Form::text('descripcion', $sedeAlterna->descripcion, ['class'=>'form-control '.($errors->has('descripcion') ? ' is-invalid' : ''), 'required']) !!}
                            @errors(['errors'=>$errors, 'field'=>'descripcion'])
                            @enderrors
                        </div>
                        <div class="form-group">
                            {!! Form::label('plantel_id', 'Plantel', ['class'=>'control-label']) !!}
                            {!! Form::select('plantel_id', $planteles, $sedeAlterna->plantel_id, ['class'=>'form-control '.($errors->has('plantel_id') ? ' is-invalid' : ''), 'required', 'placeholder'=>'Seleccione...']) !!}
                            @errors(['errors'=>$errors, 'field'=>'plantel_id'])
                            @enderrors
                        </div>

                        <div class="form-group">
                            {!! Form::label('cve_mun', 'Municipio', ['class'=>'control-label']) !!}
                            {!! Form::select('cve_mun', $municipios, $sedeAlterna->domicilio->cve_mun, ['id'=>'cve_mun', 'class'=>'form-control '.($errors->has('cve_mun') ? ' is-invalid' : ''), 'required', 'placeholder'=>'Seleccione...']) !!}
                            @errors(['errors'=>$errors, 'field'=>'cve_mun'])
                            @enderrors
                        </div>

                        <div class="form-group">
                            {!! Form::label('cve_loc', 'Localidad', ['class'=>'control-label']) !!}
                            {!! Form::select('cve_loc', $localidades, $sedeAlterna->domicilio->cve_loc, ['id'=>'cve_loc', 'class'=>'form-control '.($errors->has('cve_loc') ? ' is-invalid' : ''), 'required', 'placeholder'=>'Seleccione...']) !!}
                            @errors(['errors'=>$errors, 'field'=>'cve_loc'])
                            @enderrors
                        </div>

                        <div class="form-row pb-3">
                            <div class="form-group col">
                                {!! Form::label('calle', 'Calle', ['class'=>'control-label']) !!}
                                {!! Form::text('calle', $sedeAlterna->domicilio->calle, ['class'=>'form-control '.($errors->has('calle') ? ' is-invalid' : ''), 'required']) !!}
                                @errors(['errors'=>$errors, 'field'=>'calle'])
                                @enderrors
                            </div>
                            <div class="form-group col">
                                {!! Form::label('numero', 'Numero', ['class'=>'control-label']) !!}
                                {!! Form::text('numero', $sedeAlterna->domicilio->numero, ['class'=>'form-control '.($errors->has('numero') ? ' is-invalid' : ''), 'required']) !!}
                                @errors(['errors'=>$errors, 'field'=>'calle'])
                                @enderrors
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('colonia', 'Colonia', ['class'=>'control-label']) !!}
                            {!! Form::text('colonia', $sedeAlterna->domicilio->colonia, ['class'=>'form-control '.($errors->has('numero') ? ' is-invalid' : ''), 'required']) !!}
                            @errors(['errors'=>$errors, 'field'=>'calle'])
                            @enderrors
                        </div>
                        <div class="form-group">
                            {!! Form::label('codigo_postal', 'Codigo Postal', ['class'=>'control-label']) !!}
                            {!! Form::text('codigo_postal', $sedeAlterna->domicilio->codigo_postal, ['class'=>'form-control '.($errors->has('numero') ? ' is-invalid' : ''), 'required']) !!}
                            @errors(['errors'=>$errors, 'field'=>'calle'])
                            @enderrors
                        </div>

                        <input type="hidden" name="id" value={{  $sedeAlterna->id }}>
                        <input type="hidden" name="domicilio_id" value={{  $sedeAlterna->domicilio_id }}>

                        <div class="form-group">
                            <button class="btn btn-success" name="save">Guardar</button>
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
    <script src="/select2/dist/js/select2.js"></script>
    <script src="{{ mix('js/media/administracion/sedes_alternas/edit.js') }}"></script>
@endsection