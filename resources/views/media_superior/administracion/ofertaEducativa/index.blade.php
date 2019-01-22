@extends('layouts.app')

@section('extra-head')
@endsection

@section('navbar-title')
	Educación Media - Administración - Revisión - Oferta educativa
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<div class="card-title">Revisión<small> Oferta educativa</small></div>
						<!--<a class="btn btn-primary pull-right" title="Editar" href="{{ route('media.administracion.etapasProceso.edit') }}">Editar</a>-->
					</div>
					<div class="card-body">
						<div class="table-responsive-sm">
							<table class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Subsistema</th>
										<th>Fecha de apertura</th>
										<th>Usuario apertura</th>
										<th>Estado</th>
										<th>Impresión</th>
									</tr>
								</thead>
								<tbody>

										<tr>
											<td>{{ '1' }}</td>
											<td>{{ 'COBACH' }}</td>
											<td>{{ 'COBACH' }}</td>
											<td>{{ 'COBACH' }}</td>
											<td>{{ 'COBACH' }}</td>
											<td><a class="btn btn-success">XLS</a></td>
										</tr>

								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer"></div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('extra-scripts')
@endsection