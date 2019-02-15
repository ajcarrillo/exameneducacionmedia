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
                <h1 class="card-title" style="float: left">Listado de alumnos con problemas de curp</h1>
                <a href="{{ route('media.administracion.historico.descargar', ['subsistema_id'=>0,'formato'=>3]) }}"
                   class="btn btn-md btn-success" style="float: right"> Descargar</a>
            </div>
            <div class="card-body">
                <div class="container-fluid pt-1">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped" id="filtro">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Contacto</th>
                                    <th>Municipio</th>
                                    <th>Localidad</th>
                                    <th>Subsistema</th>
                                    <th>Plantel</th>
                                    <th>Curp historica</th>
                                    <th>Curp valida</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $cont = 1; ?>
                                @foreach($query as $aspirante)

                                    <tr>
                                        <td>{{$cont++}}</td>
                                        <td>{{$aspirante->nombre.' '.$aspirante->primer_apellido.' '.$aspirante->segundo_apellido}}</td>
                                        <td>
                                            <ul>
                                                <li><b>Correo Electronico:</b><br>{{$aspirante->email}}</li>
                                                <li><b>Telefono:</b><br>{{$aspirante->telefono}}</li>
                                                <li>
                                                    <b>Domicilio:</b><br>{{$aspirante->calle.' '.$aspirante->numero.' Col.'.$aspirante->colonia}}
                                                </li>
                                            </ul>
                                        </td>
                                        <!--<td>july@example.com</td>
                                        <td>July</td>-->
                                        <td>{{$aspirante->NOM_MUN}}</td>
                                        <td>{{$aspirante->NOM_LOC}}</td>
                                    <!--<td>{{$aspirante->calle.' '.$aspirante->numero.' Col.'.$aspirante->colonia}}</td>-->
                                        <td>{{$aspirante->subsistema}}</td>
                                        <td>{{$aspirante->plantel}}</td>
                                        <td>{{$aspirante->historica}}</td>
                                        <td>{{$aspirante->valida}}</td>
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
        $(document).ready(function () {
            $('#filtro').DataTable();
        });
    </script>
@endsection

