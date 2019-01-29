@extends('layouts.app')

@section('navbar-title')
    Enlaces
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">@include('flash::message')</div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow-none border">
                    <div class="card-header d-flex align-items-center justify-content-between border-bottom-0">
                        <h1 class="card-title w-100">Enlaces</h1>
                        <div class="">
                            <a href="{{ route('media.administracion.enlaces.create') }}" class="btn btn-primary">Agregar</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @table
                        @slot('thead')
                            <tr>
                                <th>Municipio</th>
                                <th>Fechas</th>
                                <th>Horario</th>
                                <th>Domicilio</th>
                                <th>Teléfono</th>
                                <th>Extensión</th>
                            </tr>
                        @endslot
                        @slot('tbody')
                            @forelse($enlaces as $enlace)
                                <tr>
                                    <td>
                                        <a href="{{ route('media.administracion.enlaces.edit', $enlace->id) }}">
                                            <i class="far fa-edit mr-1"></i>
                                            {{ $enlace->municipio->NOM_MUN }}
                                        </a>
                                    </td>
                                    <td>{{ $enlace->fechas }}</td>
                                    <td>{{ $enlace->horarios }}</td>
                                    <td>{{ $enlace->domicilio }}</td>
                                    <td>{{ $enlace->telefono }}</td>
                                    <td>{{ $enlace->extension }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Sin resultados</td>
                                </tr>
                            @endforelse
                        @endslot
                        @endtable
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
