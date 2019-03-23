@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">@include('flash::message')</div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        @include('administracion.pagos._archivo_form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
