<?php
/**
 * Created by PhpStorm.
 * User: abalamjimenez
 */
?>

@extends('layouts.app')

@section('extra-head')
@endsection

@section('navbar-title')
    Educación Media - Administración - Asignar Responsable subsistema
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('flash::message')
            </div>
        </div>

        <div id="avisoUsuario" class="alert alert-warning" role="alert" style="display: none">
        </div>

        <!-- INICIO DATOS SUBSISTEMA -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="card-title">Datos del Subsistema</div>
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <h5 class="font-weight-light">NOMBRE DEL SUBSISTEMA : {{$subsistema->descripcion}}</h5>
                        </div>

                        @if(!$responsable->responsable == null)
                            <div class="mb-3">
                                <h5 class="font-weight-light">RESPONSABLE : {{$responsable->responsable->nombre.' '.$responsable->responsable->primer_apellido.''.$responsable->responsable->segundo_apellido}}</h5>
                            </div>
                            <div class="mb-3">
                                <h5 class="font-weight-light">USUARIO : {{$responsable->responsable->username}}</h5>
                            </div>
                            <div class="mb-3">
                                <h5 class="font-weight-light">EMAIL: {{$responsable->responsable->email}}</h5>
                            </div>
                        @else
                            <div class="mb-3">
                                <h5 class="font-weight-bold">SIN RESPONSABLE ASIGNADO</h5>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        @if(!$responsable->responsable == null)
                            <button  type="button"  onclick="location.href = '{{route('media.administracion.responsableSubsistema.subsistema.delete_responsable',$subsistema)}} '" class="btn btn-danger btn-lg mt-3">
                                Remover Responsable
                            </button>

                            <button id="btn-actualizarResponsable" type="button" class="btn btn-success btn-lg mt-3">
                                Actualizar responsable
                            </button>
                        @else
                            <button id="btn-actualizarResponsable" type="button" class="btn btn-primary btn-lg">
                                Asignar responsable
                            </button>
                        @endif

                        <a href="{{route('media.administracion.responsableSubsistema.index')}}" class="btn btn-default  btn-lg float-right" title="Regresar">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DATOS SUBSISTEMA -->

        <!-- INICIO CAPA ASIGNAR RESPONSABLE -->
        <div id="capaAsignarResponsable" style="display: none">
            <div class="row">
                <!-- INICIO ASIGNAR RESPONSABLE EXISTENTE -->
                <div class="col-sm-5">

                    {!! Form::open(['class'=>'form-horizontal','id' =>'form', 'route'=>['media.administracion.responsableSubsistema.usr.subsistema',$subsistema]]) !!}

                    <div class="card card-primary border-success card-outline">
                        <div class="card-header">
                            <div class="card-title">Asignar responsable</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col form-group col-sm-12">
                                    @if(!$usuariosDisponibles->isEmpty())
                                        <h5 class="font-weight-light mb-3">Usuarios disponibles para asignar a
                                            este subsistema:</h5>
                                        <div class="form-group">
                                            {!! Form::select('user_id',$usuariosDisponibles,null,['class' =>'form-control','required' =>'true','placeholder' =>'selecciona'])!!}
                                        </div>
                                    @else
                                        <h5 class="font-weight-light mb-3">No hay usuarios para asignar</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            @if(!$usuariosDisponibles->isEmpty())
                                <button type="submit" class="btn btn-success btn-lg">Asignar</button>
                            @endif
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
                <!-- FIN ASIGNAR RESPONSABLE EXISTENTE -->

                <!-- INICIO CREAR Y ASIGNAR RESPONSABLE -->
                <div class="col-sm-7">

                    {!! Form::open(['class'=>'form-horizontal', 'route'=>['media.administracion.responsableSubsistema.subsistema.store',$subsistema]]) !!}

                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <div class="card-title">Crear y Asignar responsable</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col form-group">
                                    {!! Form::label('nombre', 'Nombre(s):', ['class'=>'control-label']) !!}
                                    <div class="">
                                        {!! Form::text('nombre', NULL, ['class'=>'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <div class="col form-group">
                                    {!! Form::label('apellidos', 'Primer Apellido :', ['class'=>'control-label']) !!}
                                    <div class="">
                                        {!! Form::text('primer_apellido', NULL, ['class'=>'form-control', 'required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    {!! Form::label('apellidos', 'Segundo Apellido :', ['class'=>'control-label']) !!}
                                    <div class="">
                                        {!! Form::text('segundo_apellido', NULL, ['class'=>'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <div class="col form-group">
                                    {!! Form::label('email', 'Correo electrónico:', ['class'=>'control-label']) !!}
                                    <div class="">
                                        {!! Form::email('email', NULL, ['class'=>'form-control', 'required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('password', 'Contraseña:', ['class'=>'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::password('password', ['value' =>'', 'class'=>'form-control', 'required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-lg">Guardar y asignar</button>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
                <!-- FIN CREAR Y ASIGNAR RESPONSABLE -->
            </div>
        </div>
        <!-- FIN CAPA ASIGNAR RESPONSABLE -->
    </div>
@endsection
@section('extra-scripts')
    <script src="{{mix('js/media/administracion/responsable_subsistema/eliminar.js')}}"></script>
@endsection


