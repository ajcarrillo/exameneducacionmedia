@extends('aspirante.layouts.aspirante')

@section('content')
    <div class="container-fluid">
        <div class="row pt-3">
            <div class="col-12">
                <a href="/aspirantes" style="font-size: 2rem; color: #000">
                    <i class="far fa-arrow-alt-circle-left"></i>
                    Regresar
                </a>
            </div>
            <div class="col">
                <div class="alert alert-info" role="alert">
                    Tu registro ha sido enviado por lo tanto no puedes modificar tus datos.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">
                            Datos personales
                        </h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="key col-md-2">Folio</label>
                            <label class="value col-md-10 font-weight-normal">{{ $aspirante->folio }}</label>
                        </div>
                        <div class="form-group row">
                            <label class="key col-md-2">Nombre completo</label>
                            <label class="value col-md-10 font-weight-normal">{{ get_user_full_name() }}</label>
                        </div>
                        <div class="form-group row">
                            <label class="key col-md-2">Sexo</label>
                            <label class="value col-md-10 font-weight-normal">{{ trans('sexo.'.$aspirante->sexo) }}</label>
                        </div>
                        <div class="form-group row">
                            <label class="key col-md-2">Fecha nacimiento</label>
                            <label class="value col-md-10 font-weight-normal">{{ $aspirante->fecha_nacimiento->format('d/m/Y') }}</label>
                        </div>
                        <div class="form-group row">
                            <label class="key col-md-2">CURP</label>
                            <label class="value col-md-10 font-weight-normal">{{ $aspirante->curp }}</label>
                        </div>
                        <div class="form-group row">
                            <label class="key col-md-2">País nacimiento</label>
                            <label class="value col-md-10 font-weight-normal">{{ mb_strtoupper($aspirante->paisNacimiento->descripcion, 'utf-8') }}</label>
                        </div>
                        <div class="form-group row">
                            <label class="key col-md-2">Entidad nacimiento</label>
                            <label class="value col-md-10 font-weight-normal">{{ optional($aspirante->entidadNacimiento)->descripcion }}</label>
                        </div>
                        <div class="form-group row mb-0">
                            <label class="key col-md-2">Domicilio</label>
                            <label class="value col-md-10 font-weight-normal">
                                {{ "{$aspirante->domicilio->calle} núm. {$aspirante->domicilio->numero} colonia {$aspirante->domicilio->colonia} C.P. {$aspirante->domicilio->codigo_postal}, {$aspirante->domicilio->localidad->NOM_LOC} {$aspirante->domicilio->municipio->NOM_MUN}" }}
                            </label>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="form-group row">
                            <label class="key col-md-2">Escuela de procedencia</label>
                            <label class="value col-md-10 font-weight-normal">{{ "{$aspirante->informacionProcedencia->clave_centro_trabajo} {$aspirante->informacionProcedencia->nombre_centro_trabajo}, Turno: " }}{{ trans('turnos.'.$aspirante->informacionProcedencia->turno_id) }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @include('aspirante.partials.show_seleccion', ['opciones'=> $aspirante->opcionesEducativas])
            </div>
        </div>
    </div>
@stop
