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
											<a class="btn" style="background:#00a65a;color: white;font-size: 13pt" href="{{route('planteles.reporte',['formato'=>2])}}" id="btn_imprimir">Listado
												de Acuse</a>
										</div>
										<div class="col-sm-4">
											<a class="btn" style="background:#00a65a;color: white;font-size: 13pt" href="#" id="btn_imprimir">Listado
												General</a>
										</div>
										<div class="col-sm-4">
											<a class="btn" style="background:#00a65a;color: white;font-size: 13pt" href="{{route('planteles.reporte',['formato'=>1])}}" id="btn_imprimir">Listado
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

		<div class="row">
			<div class="col-md-12">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<div class="card-title">Sedes alternas</div>
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
								@foreach($sedes as $sede)
									<tr>
										<td rowspan="2">{{ $sede->sede }}</td>
										<td class="text-right">{{ $sede->capacidad_aula }}</td>
										<td class="text-right">{{ $sede->aulas }}</td>
										<td class="text-right">{{ $sede->capacidad_ocupada }}</td>
										<td class="text-right">{{ ($sede->capacidad_ocupada / $sede->capacidad_aula)*100 }} %</td>
									</tr>
									<tr>
									</tr>
									<!-- end foreach-->
								@endforeach
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
