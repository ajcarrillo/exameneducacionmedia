@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">@include('flash::message')</div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        @include('administracion.pagos._archivo_form')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Reportes</h1>
                    </div>
                    <div class="card-body p-0 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Banco</th>
                                    <th>Fecha</th>
                                    <th>Archivo</th>
                                    <th>Depósitos reportados</th>
                                    <th>Depósitos procesados</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reportes as $reporte)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $reporte['banco'] }}</td>
                                        <td>{{ $reporte['fecha_carga'] }}</td>
                                        <td>{{ $reporte['nombre_original'] }}</td>
                                        <td>{{ $reporte['depositos_reportados'] }}</td>
                                        <td>{{ $reporte['depositos_procesados'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
