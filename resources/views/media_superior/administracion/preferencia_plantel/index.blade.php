{{-- extends --}}
@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h1 class="card-title" style="float: left">Listado de preferencia de plantel</h1>
                <a href="{{-- route('media.administracion.historico.descargar', ['subsistema_id'=>0,'formato'=>3]) --}}" class="btn btn-md btn-success" style="float: right"> Descargar</a>
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
                                <?php $cont = 1; ?>
                                 @foreach($datos as $info)

                                    <tr>
                                        <td>{{$cont++ }}</td>
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
                                {{ $datos->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
