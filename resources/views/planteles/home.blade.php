
@extends('layouts.app')

@section('extra-head')

<link rel="stylesheet" href="{{ mix('css/adminlte.css') }}">
@yield('extra-css')

@endsection

@section('navbar-title')
    Plantel - Contenido
@endsection

@section('content')

        <div class="row">
            <div class="col-md-3">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $total_oferta }}</h3>

                        <p>Oferta Educativa</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <a href="#!" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $total_demanda }}</h3>

                        <p>Demanda</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <span class="small-box-footer"><i class="fa fa-info-circle"></i></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $aspirantes_proceso_completo }}</h3>

                        <p>Aspirantes con proceso completo</p>
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
                        <h3>{{ $aspirantes_sin_pago }}</h3>
                        <p>Aspirantes sin pago efectuado</p>
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
                        <h3>{{ $aforo_suma }}</h3>

                        <p>Aforo</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-battery-full"></i>
                    </div>
                    <span class="small-box-footer"><i class="fa fa-info-circle"></i></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $aulas }}</h3>

                        <p>Aulas</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-university"></i>
                    </div>
                    <span class="small-box-footer"><i class="fa fa-info-circle"></i></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="icon ion-ios-heart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Porcentaje ocupado</span>
                        <span class="info-box-number">{{$porcentaje}}%</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: {{$porcentaje}}%"></div>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sedes alternas</h3>
                        <div class="box-tools pull-right">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            <span class="label label-primary"></span>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-hover">
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
                            @foreach($sedes as $sede)
                            <tr>
                                <td rowspan="2">{{ $sede->descripcion }}</td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td colspan="2" style="text-align: right">
                                </td>
                            </tr>
                            <!-- end foreach-->
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>



@endsection
