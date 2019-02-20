{{-- extends --}}
@extends('layouts.app')

@section('content')

    <div class="col">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h1 class="card-title" style="float: left">Listado de preferencia de plantel</h1>
                <div class="form-group form-inline float-right">

                    @if(Auth::user()->roles[0]->name == 'departamento')
                        <form action="" method="get" class="d-flex">
                        {{-- !! Form::open(['class'=>'', 'method'=>'post', 'route'=>['aspirante.guarda.cuestionario'], 'name'=>'form-cuestionario', 'id' => 'form-cuestionario']) !! --}}
                            <input type="text" name="filtro"  placeholder="Buscar..." class="form-control mr-3">
                            <select class="form-control mr-3" name="t_filtro">
                                <option value="">Tipo de filtro</option>
                                <option value="subsistema">Subsistema</option>
                                <option value="plantel">Plantel</option>
                            </select>
                            <button type="submit" class="btn btn-md btn-info mr-3">Buscar</button>
                        {{-- !! Form::close() !! --}}
                        </form>
                    @endif

                    <div class="dropdown">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            Descargar
                        </button>
                        <div class="dropdown-menu">
                            <h5 class="dropdown-header">Tipo de Descargas</h5>

                            <a href="{{ route('media.administracion.preferencia.plantel.descargarCsv', ['subsistema_id'=>0,'formato'=>4,'t_filtro'=> $t_filtro, 'filtro'=> $filtro ]) }}" class="dropdown-item" >CSV</a>
                            <a href="{{ route('media.administracion.preferencia.plantel.descargarPdf', ['subsistema_id'=>0,'formato'=>4,'t_filtro'=> $t_filtro, 'filtro'=> $filtro ]) }}" class="dropdown-item" >PDF</a>
                        </div>
                    </div>


                </div>

            </div>
            <div class="card-body">
                <div class="container-fluid pt-1">
                    <div class="row">

                        <div class="col-md-12">

                            <table class="table table-striped" id="filtro">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Folio</th>
                                    <th>Nombre Completo</th>
                                    <th>Oferta Educativa</th>
                                    <th>Subsistema</th>
                                    <th>Municipio</th>
                                    <th>Edo. de pago</th>
                                    <th>Edo. de registro</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($datos as $info)

                                    <tr>
                                        <td>{{$loop->iteration }}</td>
                                        <td>{{$info->folio}}</td>
                                        <td>{{$info->nombre_completo}}</td>

                                        <td>{{$info->primera_opcion}}</td>
                                        <td>{{$info->subsistema}}</td>
                                        <td>{{$info->municipio}}</td>
                                        <td>{{$info->pago}}</td>
                                        <td>{{$info->concluyo_registo}}</td>
                                    </tr>

                                @endforeach


                                </tbody>
                            </table>


                            <div class="card-body float-right">
                                {{-- $datos->links() --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

