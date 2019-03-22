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
                    <li><a class="mb-3" href="http://qroo.gob.mx/seq/preparatoria-abierta-quintana-roo">Preparatoria abierta</a></li>
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

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="username">Correo electrónico</label>
                                <input id="username" type="email" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
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

                                {{--<a class="btn btn-link" href="#!">
                                    ¿Olvidaste tu contraseña?
                                </a>--}}
                            </div>
                        </form>
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
