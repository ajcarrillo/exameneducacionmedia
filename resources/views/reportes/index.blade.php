@extends('layouts.app')

@section('extra-head')
    <style>
        .filters-container > form > .form-group {
            margin-bottom: 0 !important;
        }

        .reportes-list > .reporte-container:last-child {
            margin-bottom: 0 !important;
        }
    </style>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Reportes</h1>
                    </div>
                    <div class="card-body reportes-list d-flex flex-column">
                        @foreach($reportes as $reporte)
                            <div class="reporte-container mb-3">
                                <h5>{{ $reporte['descripcion'] }}</h5>
                                <div class="filters-container">
                                    <form action="{{ $reporte['url'] }}" method="POST" class="d-flex">
                                        @csrf
                                        @if($reporte['show_filters'])
                                            @if($userRoles->contains('departamento'))
                                                <div class="form-group mr-3">
                                                    <select name="municipio"
                                                            id="municipio"
                                                            class="form-control form-control-sm"
                                                    >
                                                        <option value="">Municipios</option>
                                                        @foreach($municipios as $municipio)
                                                            <option value="{{ $municipio->CVE_MUN }}">{{ $municipio->NOM_MUN }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mr-3">
                                                    <select
                                                        name="subsistema"
                                                        id="subsistema"
                                                        class="form-control form-control-sm"
                                                    >
                                                        <option value="">Subsistemas</option>
                                                        @foreach($subsistemas as $subsistema)
                                                            <option value="{{ $subsistema->id }}">{{ $subsistema->referencia }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @else
                                                <input type="hidden" name="subsistema" value="{{ get_user()->subsistema->id }}">
                                            @endif
                                            <div class="form-group mr-3">
                                                <label for="" class="mr-3">Incluir planteles y ofertas inactivos:</label>
                                                <label class="checkbox-inline">
                                                    <input type="radio" name="inactivos" id="" value="0" checked>
                                                    No
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="radio" name="inactivos" id="" value="1">
                                                    Si
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <button
                                                    class="btn btn-success btn-sm"
                                                >
                                                    Generar
                                                </button>
                                            </div>
                                        @else
                                            <a href="{{ $reporte['url'] }}" target="_blank" class="btn btn-success btn-sm">Generar</a>
                                        @endif

                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
