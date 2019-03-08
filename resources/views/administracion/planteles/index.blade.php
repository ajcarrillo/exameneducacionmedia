@extends('layouts.app')

@section('navbar-title')
    Planteles
@stop


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Lista</h1>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Clave</th>
                                    <th>Plantel</th>
                                    <th>Responsable</th>
                                    <th>Subsistema</th>
                                    <th>Descuento</th>
                                    <th>Opciones</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($planteles as $plantel)
                                    <tr>
                                        <td scope="row">{{ $plantel->clave }}</td>
                                        <td>{{ $plantel->descripcion }}</td>
                                        <td>{{ optional($plantel->responsable)->nombre }}</td>
                                        <td>{{ $plantel->subsistema->referencia }}</td>
                                        <td>
                                            <descuento-form :plantel="{{ json_encode($plantel) }}"></descuento-form>
                                        </td>
                                        <td>
                                            <opciones-form :plantel="{{ json_encode($plantel) }}"></opciones-form>
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <notifications group="foo"/>
@stop

@section('extra-scripts')
    @routes
    <script src="{{ mix('js/administracion/planteles.js') }}"></script>
@stop
