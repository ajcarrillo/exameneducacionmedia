@extends('layouts.app')

@section('extra-head')

    <link rel="stylesheet" href="{{ mix('css/adminlte.css') }}">
    @yield('extra-css')

@endsection

@section('navbar-title')
    Panel de control
@endsection

@section('content')
    <div class="container-fluid">
        {{--<div class="row">
			<div class="col-md-3">
				@if($activar == 1)
					<a class="btn" style="background:#00a65a;color: white;font-size: 13pt" href="{{route('media.administracion.panelAdministracion.cancelarOferta')}}" id="btn_desactivar">Desactivar Ofertas</a>
				@endif
			</div>
			<div class="col-md-3">
				@if($activar == 1)
						<a class="btn" style="background:#00a65a;color: white;font-size: 13pt" href="#" id="btn_desactivar_planteles">Desactivar planteles</a>
				@endif
			</div>
		</div>--}}
        <br/>
        <div class="row">
            <div class="col-md-3">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $especialidades }}</h3>

                        <p>Especialidades</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <span class="small-box-footer"><i class="fa fa-info-circle"></i></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $planteles }}</h3>

                        <p>Planteles</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <span class="small-box-footer"><i class="fa fa-info-circle"></i></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $aspirantes_hoy }}</h3>

                        <p>Nuevos aspirantes hoy</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <span class="small-box-footer"><i class="fa fa-info-circle"></i></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $total_aspirantes }}</h3>
                        <p>Total de aspirantes</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="#!" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline">
                            <div class="card-header">
                                <div class="card-title">Comportamiento de Registro</div>
                            </div>
                            <div class="card-body">
                                <canvas id="signup-stats" style="background-color: white"></canvas>
                                <!--<canvas id="speedChart" width="600" height="400"></canvas>-->
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{ $revisiones_oferta }}</h3>
                                <p>Revisión oferta</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-list-ol"></i>
                            </div>
                            <a href="#" class="small-box-footer">Ver revisiones pendientes <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{ $revisiones_aforo }}</h3>
                                <p>Revisión aforo</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-list-ol"></i>
                            </div>
                            <a href="#" class="small-box-footer">Ver revisiones pendientes <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="info-box bg-aqua">
                            <span class="info-box-icon bg-aqua-active"><i class="fa fa-bar-chart"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Folios</span>
                                <span class="info-box-number">{{ $total_folios }}</span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: {{ $porcentaje_folios }}%"></div>
                                </div>
                                <span class="progress-description">Usados: {{ $folios_usados }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <div class="info-box bg-aqua">
                            <span class="info-box-icon bg-aqua-active">
                                <i class="fas fa-id-card"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Pases al examen generados</span>
                                <span class="info-box-number">{{ $pases_al_examen }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="card-title">Planteles con demanda</div>
                        <form action="" method="get" class="d-flex flex-row justify-content-between justify-content-md-start align-items-center">

                        </form>
                    </div>
                    <div class="card-body">
                        <!--<div class="table-responsive-sm">-->
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Nombre del plantel</th>
                                    <th>Subsistema</th>
                                    <th class="text-right">Oferta educativa</th>
                                    <th class="text-right">Demanda</th>
                                    <th class="text-right">Porcentaje solicitado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($statsPlantel as $pl)
                                    <tr class="@if($pl->porcentaje > 90)table-danger @elseif($pl->porcentaje > 60)table-warning @endif">
                                        <td>{{$pl->plantel}}</td>
                                        <td>{{$pl->subsistema}} </td>
                                        <td class="text-right">{{$pl->oferta}} </td>
                                        <td class="text-right">{{$pl->demanda}} </td>
                                        <td class="text-right">{{$pl->porcentaje}} %</td>
                                    </tr>
                            @endforeach
                            <!-- end foreach-->
                            </tbody>
                        </table>
                        <!--</div>-->
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="fecha" value="{{$fechas_r}}">
    <input type="hidden" id="persona" value="{{$dato}}">

@endsection

@section('extra-scripts')
    <script src="{{mix('js/administracion/panel_departamento/home.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script>
        var data = $('#fecha').val();
        var count = $('#persona').val();

        $(document).ready(function () {
            var speedCanvas = document.getElementById("signup-stats");
            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 18;
            var speedData = {
                labels: JSON.parse(data),
                datasets: [{
                    label: "Comportamiento de registro",
                    //data: [0, 59, 75, 20, 20, 55, 40],
                    data: JSON.parse(count),
                    backgroundColor: "rgba(75,192,192,0.4)",
                    borderColor: "rgba(75,192,192,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(60, 141, 188, 1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 5,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10
                }]
            };
            var chartOptions = {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 80,
                        fontColor: 'black'
                    }
                }
            };

            var lineChart = new Chart(speedCanvas, {
                type: 'line',
                data: speedData,
                options: chartOptions
            });
        });
    </script>
@endsection

