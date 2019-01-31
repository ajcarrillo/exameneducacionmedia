@extends('layouts.app')

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
                            {!! Form::select('cve_mun', $municipios, $domicilio->cve_mun, ['class'=>'form-control '.($errors->has('cve_mun') ? ' is-invalid' : ''), 'required', 'placeholder'=>'Seleccione...']) !!}
                            @errors(['errors'=>$errors, 'field'=>'cve_mun'])
                            @enderrors
                        </div>

                        <div class="form-group">
                            {!! Form::label('cve_loc', 'Localidad', ['class'=>'control-label']) !!}
                            {!! Form::select('cve_loc', $localidades, $domicilio->cve_loc, ['class'=>'form-control '.($errors->has('cve_loc') ? ' is-invalid' : ''), 'required', 'placeholder'=>'Seleccione...']) !!}
                            @errors(['errors'=>$errors, 'field'=>'cve_loc'])
                            @enderrors
                        </div>
                        <div class="form-row pb-3">
                            <div class="col">
                                <label for="">Calle</label>
                                <input class="form-control" name="calle" value={{ $domicilio->calle }} required type="text" >
                            </div>
                            <div class="col">
                                <label for="numero">Número</label>
                                <input class="form-control" name="numero" value= {{ $domicilio->numero }} type="text" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Colonia</label>
                            <input class="form-control" name="colonia" value={{ $domicilio->colonia }} required type="text" >
                        </div>
                        <div class="form-group">
                            <label for="">Código postal</label>
                            <input class="form-control" name="codigo_postal" value={{ $domicilio->codigo_postal }} type="text" >
                        </div>
                        <input type="hidden" name="domicilio_id" value={{  $domicilio->id }}>

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
