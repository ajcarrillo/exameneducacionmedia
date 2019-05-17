@extends('layouts.app')

@section('extra-head')

    <link rel="stylesheet" href="{{ mix('css/adminlte.css') }}">
    @yield('extra-css')

@endsection

@section('navbar-title')
    Plantel - Contenido
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="small-box @if($total_demanda>$stats[0]->oferta) bg-danger @else bg-success @endif">
                    <div class="inner">
                        <h3>{{ $total_demanda }}</h3>

                        <p>Demanda</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="#!" data-toggle="modal" data-target="#modelId" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $stats[0]->oferta }}</h3>

                        <p>Oferta</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="#!" data-toggle="modal" data-target="#modelId" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $total_oferta }}</h3>

                        <p>Especialidades</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <span class="small-box-footer"><i class="fa fa-info-circle"></i></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $aforo_suma }}</h3>

                        <p>Aforo</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <span class="small-box-footer"><i class="fa fa-info-circle"></i></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $aspirantes_proceso_completo }}</h3>

                        <p>Aspirantes con proceso completo</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="#!" data-toggle="modal" data-target="#modelId" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $aspirantes_con_pago }}</h3>
                        <p>Aspirantes con pago efectuado</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="#!" data-toggle="modal" data-target="#modelId" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $aspirantes_sin_pago }}</h3>
                        <p>Aspirantes sin pago efectuado</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="#!" data-toggle="modal" data-target="#modelId" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $aspirantes_sin_envio }}</h3>
                        <p>Aspirantes sin enviar registro</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="#!" data-toggle="modal" data-target="#modelId" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">Información</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <p><span class="text-bold">Demanda:</span> Aspirantes que eligieron el plantel como primero opción</p>
                                <p><span class="text-bold">Aspirantes con proceso completo:</span> Aspirantes con pase al examen</p>
                                <p><span class="text-bold">Aspirantes sin pago efectuado:</span> Aspirantes que enviaron su registro pero no han pagado</p>
                                <p><span class="text-bold">Aspirantes con pago efectuado:</span> Aspirantes <strong>que enviaron</strong> su registro y ya pagaron</p>
                                <p><span class="text-bold">Aspirantes sin enviar registro:</span> Aspirantes que no han enviado registro</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon bg-green-active"><i class="fa fa-bar-chart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Porcentaje ocupado</span>
                        <span class="info-box-number">{{$porcentaje}} %</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: {{$porcentaje}}%"></div>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>

        <div class="row pb-3">
            <div class="col">
                <a class="btn" style="background:#00a65a;color: white;font-size: 13pt" href="{{route('planteles.reporte',['formato'=>2])}}" id="btn_imprimir">Listado
                    de Acuse</a>
                <a class="btn" style="background:#00a65a;color: white;font-size: 13pt" href="{{route('planteles.reporte',['formato'=>3])}}" id="btn_imprimir" target="_blank">Listado
                    General</a>
                <a class="btn" style="background:#00a65a;color: white;font-size: 13pt" href="{{route('planteles.reporte',['formato'=>1])}}" id="btn_imprimir">Listado
                    de Alumnos</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="card-title">Sedes alternas</div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sede</th>
                                    <th class="text-right">Capacidad</th>
                                    <th class="text-right">Aulas</th>
                                    <th class="text-right">Capacidad ocupada</th>
                                    <th class="text-right">Porcentaje ocupado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sedes as $sede)
                                    <tr>
                                        <td>{{ $sede->descripcion }}</td>
                                        <td class="text-right">{{ $sede->capacidadTotal() }}</td>
                                        <td class="text-right">{{ $sede->totalAulas() }}</td>
                                        <td class="text-right">{{ $sede->totalPases() }}</td>
                                        <td class="text-right">
                                            {{ floor(($sede->totalPases()/$sede->capacidadTotal()) * 100) }}%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <a href="{{route('planteles.reporte',['formato'=>22,'sede_alterna'=>$sede->id])}}" class="btn btn-success">Listado acuse</a>
                                            <a href="{{route('planteles.reporte',['formato'=>33,'sede_alterna'=>$sede->id])}}" class="btn btn-success">Listado general</a>
                                            <a href="{{route('planteles.reporte',['formato'=>11,'sede_alterna'=>$sede->id])}}" class="btn btn-success">Listado alumnos</a>
                                        </td>
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
