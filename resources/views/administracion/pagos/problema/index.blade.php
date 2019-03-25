@extends('layouts.app')

@section('extra-head')
    <style>
        .overlay-fade-enter-active,
        .overlay-fade-leave-active {
            transition: all 0.2s;
        }

        .overlay-fade-enter,
        .overlay-fade-leave-active {
            opacity: 0;
        }

        .nice-modal-fade-enter-active,
        .nice-modal-fade-leave-active {
            transition: all 0.4s;
        }

        .nice-modal-fade-enter,
        .nice-modal-fade-leave-active {
            opacity: 0;
            transform: translateY(-20px);
        }
    </style>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">@include('flash::message')</div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">
                            Busqueda de referencia
                        </h1>
                    </div>
                    <div class="card-body pb-0">
                        @include('administracion.pagos.problema._referencia_form')
                    </div>
                    @verbatim
                        <div v-if="ready" class="card-body pb-0">
                            <h5>Depositos realizados a la referencia <strong>{{ form.referencia }}</strong></h5>
                            <ul class="list-unstyled">
                                <li><strong>Total de depositos: {{ billy.resumen.cant_depositos }}</strong></li>
                                <li><strong>Total de solicitudes: {{ billy.resumen.cant_solicitudes }}</strong></li>
                            </ul>
                            <div class="alert alert-warning mt-3 mb-0" role="alert" v-if="hasAProblem">
                                <strong>Oops! Parece haber un problema con esta referencia de pago.!</strong>
                            </div>
                        </div>
                        <div v-if="ready" class="card-body table-responsive px-0 pb-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Banco</th>
                                        <th>Fecha pago</th>
                                        <th>Total</th>
                                        <th>Pagado por</th>
                                        <th>Fecha solicitud</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr v-for="deposito in billy.depositos">
                                        <td class="align-middle">{{ deposito.reporte.banco }}</td>
                                        <td class="align-middle">{{ deposito.fecha }}</td>
                                        <td class="align-middle">{{ deposito.abono }}</td>
                                        <td class="align-middle">{{ deposito.solicitud_pago ? deposito.solicitud_pago.contribuyente : ''}}</td>
                                        <td class="align-middle">{{ deposito.solicitud_pago ? deposito.solicitud_pago.fecha_solicitud : ''}}</td>
                                        <td>
                                            <template v-if="!deposito.solicitud_pago">
                                                <button class="btn btn-primary" @click="asignar(deposito.id)">Asignar</button>
                                            </template>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <modal name="hello-world"
                               width="100%"
                               classes="v--modal rounded-0"
                               height="100%"
                               transition="overlay-fade"
                        >
                            <div class="container" style="padding-top: 4.5rem">
                                <div class="row">
                                    <div class="col">
                                        <buscar-aspirante-form></buscar-aspirante-form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <aspirantes-table></aspirantes-table>
                                    </div>
                                </div>
                            </div>
                        </modal>
                    @endverbatim
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    @routes
    <script type="text/javascript">
        window.__INITIAL_STATE__ = "{!! addslashes(json_encode($url)) !!}";
    </script>
    <script src="{{ mix('js/administracion/pagos/problema/app.js') }}"></script>
@endsection
