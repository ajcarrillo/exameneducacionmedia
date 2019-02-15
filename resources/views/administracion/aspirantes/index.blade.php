@extends('layouts.app')

@section('navbar-title')
    Aspirantes
@stop

@section('content')
    <div class="container-fluid">
        <div class="row pb-3">
            <div class="col">
                <a href="{{ route('media.administracion.historico.curp') }}"
                   class="btn btn-primary">Ver aspirantes con problemas con curp</a>
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
                              class="d-flex">
                            <div class="pr-3 flex-fill">
                                <input type="text"
                                       class="form-control"
                                       name="search"
                                       placeholder="Ingresa nombre o email"
                                       minlength="4"
                                       value="{{ request('search') }}"
                                       autofocus
                                >
                                <small class="text-muted">Mínimo 4 caracteres</small>
                            </div>
                            <div class="pr-3 flex-fill">
                                <input type="text"
                                       class="form-control"
                                       name="curp"
                                       placeholder="Ingresa folio o curp"
                                       value="{{ request('curp') }}"
                                       minlength="4"
                                >
                                <small class="text-muted">Mínimo 4 caracteres</small>
                            </div>
                            <div>
                                <button class="btn btn-primary">Buscar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body p-0">
                        @table
                        @slot('thead')
                            <tr>
                                <th>Nombre</th>
                                <th>Folio</th>
                                <th>Email</th>
                                <th>CURP</th>
                                <th>Opciones</th>
                            </tr>
                        @endslot
                        @slot('tbody')
                            @forelse($users as $user)
                                <tr>
                                    <td>
                                        <a href="#!">
                                            <i class="far fa-id-card pr-2"></i>
                                            {{ get_full_name_from_user($user) }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $user->aspirante->folio }}
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        {{ $user->aspirante->curp }}
                                    </td>
                                    <td>
                                        @include('partials.login_as_user_form')
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
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
