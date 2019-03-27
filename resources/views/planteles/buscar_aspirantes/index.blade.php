@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h1 class="card-title flex-fill">Aspirantes</h1>
                        <div class="search flex-fill">
                            <form action="{{ route('planteles.aspirantes') }}">
                                <div class="input-group">

                                    <input type="text"
                                           class="form-control form-control-sm"
                                           name="search"
                                           minlength="6"
                                           min="6"
                                           value="{{ request('search') }}"
                                           placeholder="Introduce nombre completo, matricula, curp, folio o email"
                                           autofocus>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend3">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Folio</th>
                                    <th>Matrícula</th>
                                    <th>CURP</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($aspirantes as $aspirante)
                                    <tr>
                                        <td scope="row">{{$loop->iteration}}</td>
                                        <td>{{ $aspirante->nombre_completo }}</td>
                                        <td>{{ $aspirante->folio }}</td>
                                        <td>{{ $aspirante->matricula }}</td>
                                        <td>{{ $aspirante->curp }}</td>
                                        <td>{{ $aspirante->email }}</td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
