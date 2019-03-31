@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-2">
                @verbatim
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Estatus billy</div>
                        </div>
                        <div class="card-body">
                            <h3>
                                <span class="badge" :class="{'badge-success': billyStatus, 'badge-danger': !billyStatus}">
                                    {{ billyStatusCaption }}
                                </span>
                            </h3>
                        </div>
                    </div>
                @endverbatim
            </div>
        </div>
    </div>
@stop

@section('extra-scripts')
    <script>
        window.BILLY_SERVICE_URL = '{{ env('BILLY_SERVICE_URL') }}';
    </script>
    <script src="{{ mix('js/developer_zone/services.js') }}"></script>
@stop
