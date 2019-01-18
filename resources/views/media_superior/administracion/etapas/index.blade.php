<?php
/**
 * Created by PhpStorm.
 * User: igna
 */
?>

@extends('layouts.app')

@section('extra-head')
@endsection

@section('navbar-title')
    Educación Media - Administración - Etapas del proceso
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('flash::message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="card-title">Fechas</div>
                        <div class="pull-right">
                            <a class="btn btn-primary" title="Nuevo ciclo escolar"
                               href="#">Nuevo</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-bordered table-striped table-hover" id="ciclosEscolaresTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>---</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
@endsection


