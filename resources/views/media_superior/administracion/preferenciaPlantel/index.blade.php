{{-- extends --}}
@extends('layouts.app')

@section('extra-head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
@endsection

@section('content')
    <div class="col">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h1 class="card-title" style="float: left">Listado de preferencia de plantel</h1>
                <a href="{{-- route('media.administracion.historico.descargar', ['subsistema_id'=>0,'formato'=>3]) --}}" class="btn btn-md btn-success" style="float: right"> Descargar</a>
            </div>
            <div class="card-body">
                <div class="container-fluid pt-1">
                    <div class="row justify-content-md-center">
                        <div class="col-md-11">
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
                                        <td>{{--$aspirante->plantel--}}</td>
                                    </tr>

                                 @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('extra-scripts')
    <script src="{{ asset('datatables/datatables.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#filtro').DataTable();
        } );
    </script>
@endsection