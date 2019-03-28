@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">@include('flash::message')</div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">
                            Actualizar contraseña
                        </h1>
                    </div>
                    <div class="card-body">
                        <h5>{{ get_full_name_from_user($user) }}</h5>
                        <form action="{{ route('planteles.aspirantes.actualizar.pass',  $user->uuid) }}"
                              method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <input type="password"
                                       name="password"
                                       placeholder="Nueva contraseña"
                                       class="form-control mr-3{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button class="btn btn-success">Actualizar</button>
                            <a href="{{ route('planteles.aspirantes') }}" class="btn btn-default">Regresar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
