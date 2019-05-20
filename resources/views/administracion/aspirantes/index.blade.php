@extends('layouts.app')

@section('navbar-title')
    Aspirantes
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                @include('flash::message')
            </div>
        </div>
        <div class="row pb-3">
            <div class="col">
                <a href="{{ route('media.administracion.historico.curp') }}"
                   class="btn btn-primary">Ver aspirantes con problemas con curp</a>
                <form action="{{ route('media.administracion.aspirantes.generar.pases.automaticos') }}"
                      method="post"
                      class="d-inline-block"
                >
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="conpagosinpase" value="1">
                    <button class="btn btn-success">Generar pases al examen</button>
                </form>
            </div>
            <div class="col">

            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h1 class="card-title">
                            Buscar aspirantes
                        </h1>
                    </div>
                    <div class="card-body">
                        <form action="" method="get"
                              class="d-flex align-items-center">
                            <div class="pr-3 flex-fill">
                                <label class="checkbox-inline">
                                    <input type="radio"
                                           name="conpagosinpase"
                                           id="conpagosinpase"
                                           value="1"
                                        {{ !request('conpagosinpase') ?: 'checked' }}
                                    >
                                    Aspirantes con pago sin pase
                                </label>
                                <input type="text"
                                       class="form-control"
                                       name="search"
                                       placeholder="Ingresa: nombre, matrícula, email, folio o curp"
                                       minlength="4"
                                       value="{{ request('search') }}"
                                       autofocus
                                >
                                <small class="text-muted">Mínimo 4 caracteres</small>
                            </div>
                            <div class="align-self-center">
                                <button class="btn btn-primary">Buscar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body p-0">
                        @table
                        @slot('thead')
                            <tr>
                                <th>Nombre</th>
                                <th>Matrícula</th>
                                <th>Folio</th>
                                <th>Email</th>
                                <th>CURP</th>
                                <th>Opciones</th>
                            </tr>
                        @endslot
                        @slot('tbody')
                            @forelse($aspirantes as $aspirante)
                                <tr>
                                    <td>
                                        <a href="{{ route('media.administracion.aspirantes.show', $aspirante->id) }}">
                                            <i class="far fa-id-card pr-2"></i>
                                            {{ $aspirante->nombre_completo }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $aspirante->matricula }}
                                    </td>
                                    <td>
                                        {{ $aspirante->folio }}
                                    </td>
                                    <td>{{ $aspirante->email }}</td>
                                    <td>
                                        {{ $aspirante->curp }}
                                    </td>
                                    <td>
                                        <form action="{{ route('login.as.user', ['userId'=>$aspirante->user_id]) }}" method="post">
                                            @csrf
                                            <button class="btn btn-success" type="submit">
                                                Iniciar sesión
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">SIN RESULTADOS</td>
                                </tr>
                            @endforelse
                        @endslot
                        @endtable
                    </div>
                    <div class="card-footer">
                        {{ $aspirantes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
