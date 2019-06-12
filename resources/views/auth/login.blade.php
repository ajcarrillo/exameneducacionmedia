@extends('layouts.app')

@section('navbar-title')
    Iniciar sesión
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <h1 class="mb-3">Sistema de Registro al Examen de Ingreso a la Educación Media</h1>
                <ul>
                    <li><a class="mb-3" href="{{ asset('descargas/CONVOCATORIA_PAEMS_2019.pdf') }}">Convocatoria PAENMS 2019</a></li>
                    <li><a class="mb-3" href="{{ asset('img/prepa_abierta.jpg') }}" target="_blank">Preparatoria abierta</a></li>
                    <li><a class="mb-3" href="http://www.prepaenlinea.sep.gob.mx/">Preparatoria en línea</a></li>
                    <li><a class="mb-3" href="http://www.facebook.com/paenmsqroo">Asesorías y dudas</a></li>
                    <li><a class="mb-3" href="/">Ir al inicio</a></li>
                </ul>
                <h2 class="mb-3">Descarga</h2>
                <ul>
                    <li><a class="text-center mb-3 flex-fill" href="{{ asset('descargas/guia_de_estudios.pdf') }}">Guía de estudios EXANI-I CENEVAL</a></li>
                    {{--<li><a class="text-center mb-3 flex-fill" href="http://siem.seq.gob.mx/static/media/catalogo_opciones_educativas.pdf">Catálogo de preparatorias públicas en
                            Quintana Roo</a></li>
                    <li>
                        <a class="text-center mb-3 flex-fill" href="http://siem.seq.gob.mx/static/media/Preparatoria_Abierta_del_Colegio_de_Bachilleres_del_Estado_de_Quintana_Roo.pdf">Preparatoria
                            Abierta en el Colegio de Bachilleres</a></li>--}}
                </ul>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Entrar</div>

                    <div class="card-body pb-0">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email">Correo electrónico</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="password">Contraseña</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row mb-0">
                                <button type="submit" class="btn btn-primary">
                                    Entrar
                                </button>

                                <a class="btn btn-link" href="{{ route('forgot.password') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>

                            <div class="form-group row mb-0 mt-3">
                                <a href="{{ route('aviso.privacidad') }}">
                                    Aviso de privacidad
                                </a>
                            </div>
                        </form>
                    </div>
                    <div class="card-body pb-0 pt-0">
                        @guest
                            @if(is_etapa_registro())
                                <div class="register links d-flex flex-column justify-content-center">
                                    <a href="/aspirantes/registro-matricula"
                                       class="mb-3"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Aspirantes que ESTUDIAN o ESTUDIARON algún grado en el estado de Quintana Roo"
                                    >
                                        Registro alumnos de Quintana Roo
                                    </a>
                                    <a href="/aspirantes/registro-externo"
                                       class="mb-3">
                                        <span>Registro alumnos de otros estados</span>
                                    </a>
                                    <a href="/aspirantes/registro-externo"
                                       class="">
                                        <span>Registro alumnos extranjeros</span>
                                    </a>
                                </div>
                            @endif
                        @endguest
                    </div>
                    <div class="card-body pb-0">
                        <p>Para un funcionamiento óptimo del sistema utilizar el navegador Google Chrome</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-7">
                <img
                    class="img-fluid"
                    src="{{ asset('img/secretaria-seq.png') }}"
                    alt="Secretaría de Educación de Quintana Roo">
            </div>
        </div>
    </div>
@endsection
