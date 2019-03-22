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
                    <div class="card-body pb-0">
                        <form action="" id="emptyForm"></form>
                        <form action="" method="get">
                            <div class="d-flex flex-wrap justify-content-around">
                                @foreach($subsistemas as $subsistema)
                                    <label class="checkbox-inline">
                                        <input type="radio"
                                               name="subsistema"
                                               id="subsistema"
                                               value="{{ $subsistema->id }}"
                                            {{ $subsistema->id == request('subsistema') ? 'checked':'' }}>
                                        {{ $subsistema->referencia }}
                                    </label>
                                @endforeach
                                <label class="checkbox-inline">
                                    <input type="radio"
                                           name="subsistema"
                                           id="subsistema"
                                           value=""
                                           onclick="document.getElementById('emptyForm').submit()">
                                    TODOS
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="text"
                                       name="search"
                                       class="form-control"
                                       placeholder="Ingresa un nombre del plantel o clave"
                                       value="{{ request('search') }}">
                            </div>
                            <button class="d-none">Buscar</button>
                        </form>
                        <span class="btn btn-primary d-block" style="margin: 0 auto">
                            <span class="badge badge-light">{{ $planteles->count() }}</span> Planteles
                        </span>

                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="1%">Clave</th>
                                    <th width="5%">Plantel</th>
                                    <th width="5%">Responsable</th>
                                    <th width="5%">Subsistema</th>
                                    <th width="5%">Acitvo</th>
                                    <th width="5%">Descuento</th>
                                    <th width="5%">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($planteles as $plantel)
                                    <tr>
                                        <td class="align-middle" scope="row">{{ $plantel->clave }}</td>
                                        <td class="align-middle">{{ $plantel->descripcion }}</td>
                                        <td class="align-middle">
                                            {{ get_full_name_from_user($plantel->responsable) ?? 'NO ASIGNADO' }}
                                        </td>
                                        <td class="align-middle">{{ $plantel->subsistema->referencia }}</td>
                                        <td class="align-middle">{{ trans('sino.'.$plantel->active) }}</td>
                                        <td>
                                            <descuento-form :plantel="{{ json_encode($plantel) }}"></descuento-form>
                                        </td>
                                        <td>
                                            <opciones-form :plantel="{{ json_encode($plantel) }}"></opciones-form>
                                        </td>
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
