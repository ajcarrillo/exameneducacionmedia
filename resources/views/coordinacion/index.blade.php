@extends('layouts.app')

@section('navbar-title')
    Coordinación
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex justify-content-around">
                        <div class="text-center">
                            <h1>{{ $aspirantes }}</h1>
                            <p class="mb-0" style="cursor: pointer" data-toggle="modal" data-target="#modal-glosario">
                                Aspirantes
                                <i class="far fa-question-circle"></i>
                            </p>
                        </div>
                        <div class="text-center">
                            <h1>{{ $oferta }}</h1>
                            <p class="mb-0" style="cursor: pointer" data-toggle="modal" data-target="#modal-glosario">
                                Oferta
                                <i class="far fa-question-circle"></i>
                            </p>
                        </div>
                        <div class="text-center">
                            <h1>{{ $demanda }}</h1>
                            <p class="mb-0" style="cursor: pointer" data-toggle="modal" data-target="#modal-glosario">
                                Demanda
                                <i class="far fa-question-circle"></i>
                            </p>
                        </div>
                        <div class="text-center">
                            <h1>{{ $pases }}</h1>
                            <p class="mb-0" style="cursor: pointer" data-toggle="modal" data-target="#modal-glosario">
                                Aspirantes con pase
                                <i class="far fa-question-circle"></i>
                            </p>
                        </div>
                        <div class="text-center">
                            <h1>{{ $sinPase }}</h1>
                            <p class="mb-0" style="cursor: pointer" data-toggle="modal" data-target="#modal-glosario">
                                Aspirantes sin pase
                                <i class="far fa-question-circle"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Top 10 planteles con mayor demanda</h1>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Plantel</th>
                                    <th>Subsistema</th>
                                    <th class="text-right">Oferta</th>
                                    <th class="text-right">Demanda</th>
                                    <th class="text-right">Porcentaje</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topTen as $plantel)
                                    <tr class="@if($plantel->demanda > $plantel->oferta) bg-danger @endif">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $plantel->plantel }}</td>
                                        <td>{{ $plantel->subsistema }}</td>
                                        <td class="text-right">{{ $plantel->oferta }}</td>
                                        <td class="text-right">{{ $plantel->demanda }}</td>
                                        <td class="text-right">{{ $plantel->porcentaje }}%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <subsistema-oferta-demanda :datos="{{ json_encode($subsistemasDemandaOferta) }}"></subsistema-oferta-demanda>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <aspirante-sexo :datos="{{ json_encode($sexos)  }}"
                                :porentidad="{{ json_encode($porEntidad) }}"
                                :porpais="{{ json_encode($porPais) }}"
                                :nulos="{{ json_encode($nulos) }}"
                >
                </aspirante-sexo>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Top 20 especialidades con mayor de demanda</h1>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subsistema/Especialidad</th>
                                    <th class="text-right">Total aspirantes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topEspecialidades as $especialidad)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $especialidad->especialidad }}</td>
                                        <td class="text-right">{{ $especialidad->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <p class="mb-0 text-bold">* Especialidades que fueron elegidas como primera opción por los aspirantes</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('extra-scripts')
    <script src="{{ mix('js/coordinador/app.js') }}"></script>
@stop
