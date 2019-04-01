@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                @verbatim
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Estatus billy</div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Servicio</th>
                                        <th>Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">Billy por frontend</td>
                                        <td>
                                            <span class="badge" :class="{'badge-success': billyStatus, 'badge-danger': !billyStatus}">
                                                {{ billyStatusCaption }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Billy por backend</td>
                                        <td>
                                            <span class="badge" :class="{'badge-success': initialState.billyStatus, 'badge-danger': !initialState.billyStatus}">
                                                {{ billyStatusBackCaption }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endverbatim
            </div>
        </div>
    </div>
@stop

@section('extra-scripts')
    <script>
        window.__INITIAL_STATE__ = "{!! addslashes(json_encode([
        'billyStatus'=>$billyStatus,
        'billyServiceUrl'=> env('BILLY_SERVICE_URL')
        ])) !!}";
    </script>
    <script src="{{ mix('js/developer_zone/services.js') }}"></script>
@stop
