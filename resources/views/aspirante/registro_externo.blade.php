@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="alert alert-info" role="alert">
                            <strong>¡Atención!</strong>
                            Haz click <a href="/aspirantes/registro-matricula">AQUÍ</a> si ESTUDIAS o ESTUDIASTE algún grado en el estado de Quintana Roo
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <form action="{{ route('registro.externo') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" value="{{ old('nombre') }}" name="nombre" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="">Primer apellido</label>
                                <input type="text" class="form-control" value="{{ old('primer_apellido') }}" name="primer_apellido" required>
                            </div>
                            <div class="form-group">
                                <label for="">Segundo apellido</label>
                                <input type="text" class="form-control" value="{{ old('segundo_apellido') }}" name="segundo_apellido">
                            </div>

                            <div class="form-group">
                                <label for="">Fecha nacimiento</label>
                                <input type="date" class="form-control{{ $errors->has('fecha_nacimiento') ? ' is-invalid' : '' }}" value="{{ old('fecha_nacimiento') }}" name="fecha_nacimiento">
                                @if ($errors->has('fecha_nacimiento'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="">Correo electrónico</label>
                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" name="email" required>
                                    <small class="text-muted">
                                        Escribe una dirección de correo electrónico a la que tengas acceso
                                    </small>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-sm-6">
                                    <label for="">Contraseña</label>
                                    <input type="password" class="form-control" name="password" required>
                                    <small class="text-muted">Escribe una contraseña que recuerdes</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-success btn-block">Registrarse</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
