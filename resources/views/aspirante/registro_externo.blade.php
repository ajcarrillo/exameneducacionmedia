@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form action="">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" name="nombre" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="">Primer apellido</label>
                                <input type="text" class="form-control" name="primer_apellido" required>
                            </div>
                            <div class="form-group">
                                <label for="">Segundo apellido</label>
                                <input type="text" class="form-control" name="segundo_apellido">
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="">Correo electrónico</label>
                                    <input type="email" class="form-control" required>
                                    <small class="text-muted">
                                        Escribe una dirección de correo electrónico al que tengas acceso
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-sm-6">
                                    <label for="">Usuario</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="">Contraseña</label>
                                    <input type="password" class="form-control">
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
