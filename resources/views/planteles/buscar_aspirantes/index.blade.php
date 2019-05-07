@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">@include('flash::message')</div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <form action="{{ route('reporte.general.aspirnates') }}" method="post">
                    @csrf()
                    <button class="btn btn-success">
                        Descargar listado
                    </button>
                </form>
            </div>
        </div>
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
                        <ul class="list-unstyled">
                            @forelse($aspirantes as $aspirante)
                                <li class="py-3 px-3 border-bottom">
                                    <div class="mb-3 d-flex align-items-center">
                                        <h5 class="text-bold mb-0 mr-3">
                                            {{$loop->iteration}} - {{ $aspirante->nombre_completo }}
                                        </h5>
                                    </div>
                                    <div class="d-flex">
                                        <div class="mr-3"><span class="text-bold">Folio: </span>{{ $aspirante->folio }}</div>
                                        <div class="mr-3"><span class="text-bold">Matrícula: </span>{{ $aspirante->matricula }}</div>
                                        <div class="mr-3"><span class="text-bold">CURP: </span>{{ $aspirante->curp }}</div>
                                        <div class="mr-3"><span class="text-bold">Email: </span>{{ $aspirante->email }}</div>
                                    </div>
                                    <div class="box-tools d-flex">
                                        <a href="{{ route('planteles.aspirantes.show.form', $aspirante->uuid) }}">Reiniciar contraseña</a>
                                    </div>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                    <div class="card-footer">
                        {{ $aspirantes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
