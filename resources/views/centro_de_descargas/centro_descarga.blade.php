@extends((( $name_role->name == 'aspirante') ? 'aspirante.layouts.aspirante' : 'layouts.app' ))
@section('extra-head')
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('content')

	<div class="row justify-content-center">
		<div class="card card-primary card-outline col-md-7 mt-5 col-md-9">
			<div class="card-header">
				<h1 class="card-title">Centro de descargas</h1>
			</div>
			<div class="card-body text-center pb-0">
				<div class="table-responsive-sm">
					<table class="table table-bordered table-striped table-hover" id="filtro">
						<thead>
							<tr>
								<th>#</th>
								<th>Nombre del archivo</th>
								<th>Descripción</th>
								<th>Descargar</th>
							</tr>
						</thead>
						<tbody>
							@if(!empty($documentos))
								@foreach($documentos as $doc)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $doc->archivo->nombre }}</td>
										<td>{{ $doc->archivo->descripcion }}</td>
										<td>
											<a class="btn btn-primary font-weight-light" href="{{route('centro-descarga.descargar.doc',$doc->archivo->id) }}">
												<i class="fa fa-download"> </i>
												Descargar</a>
										</td>
									</tr>
								@endforeach
						</tbody>
						@else
							<tr>
								<td colspan="8">No hay registros.</td>
							</tr>
						@endif
					</table>
				</div>
			</div>
		</div>
	</div>
	
@endsection
@section('extra-scripts')
	<script src="{{ asset('datatables/datatables.js') }}"></script>
	<script>
        $('#filtro').DataTable();
	</script>
@endsection




