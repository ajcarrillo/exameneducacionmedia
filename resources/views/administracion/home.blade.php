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
			    @if($activar == 1)
				    <a class="btn" style="background:#00a65a;color: white;font-size: 13pt" href="{{route('media.administracion.panelAdministracion.cancelarOferta')}}" id="btn_desactivar">Desactivar Ofertas</a>
			    @endif
		    </div>
            <div class="col-md-3">
                @if($activar == 1)
                        <a class="btn" style="background:#00a65a;color: white;font-size: 13pt" href="#" id="btn_desactivar_planteles">Desactivar planteles</a>
                @endif
            </div>
	    </div>
	    <br />
        <div class="row">
            <div class="col-md-3">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>45</h3>

                        <p>Especialidades</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <a href="#!" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>23</h3>

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
                        <h3>233</h3>

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
                        <h3>233</h3>
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
            <div class="col-md-3">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>...</h3>

                        <p>Comportamiento de registro</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-battery-full"></i>
                    </div>
                    <span class="small-box-footer"><i class="fa fa-info-circle"></i></span>
                </div>
            </div>
            <div class="col-md-6">
                <p>

                    <a class="btn btn-lg btn-block" style="background:#00a65a;color: white;font-size: 13pt" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">					<span class="small-box-footer"><i class="fa fa-info-circle"></i></span>
                        Impresión
                        de Reportes</a>
                </p>
                <div class="row">
                    <div class="col">
                        <div class="collapse multi-collapse" id="multiCollapseExample1">
                            <div class="small-box">
                                <div class="card card-body bg-gray-light">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a class="btn" style="background:#00a65a;color: white;font-size: 13pt" href="#" id="btn_imprimir">Listado
                                                de Acuse</a>
                                        </div>
                                        <div class="col-sm-4">
                                            <a class="btn" style="background:#00a65a;color: white;font-size: 13pt" href="#" id="btn_imprimir">Listado
                                                General</a>
                                        </div>
                                        <div class="col-sm-4">
                                            <a class="btn" style="background:#00a65a;color: white;font-size: 13pt" href="#" id="btn_imprimir">Listado
                                                de Alumnos</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon bg-green-active"><i class="fa fa-bar-chart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Folios</span>
                        <span class="info-box-number"> 23%</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 23%"></div>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="card-title">Planteles con demanda</div>
                    </div>
                    <div class="card-body">
                        <!--<div class="table-responsive-sm">-->
                        <table class="table table-hover table-responsive-sm">
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
                            <!-- foreach-->
                            <tr>
                                <td rowspan="2"></td>
                                <td class="text-right"> </td>
                                <td class="text-right"> </td>
                                <td class="text-right"> </td>
                                <td class="text-right"> </td>
                            </tr>
                            <tr>
                            </tr>
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
@endsection

@section('extra-scripts')
    <script src="{{mix('js/administracion/panel_departamento/home.js')}}"></script>
@endsection
