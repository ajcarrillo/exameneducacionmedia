@extends('layouts.app')

@section('extra-head')

@endsection

@section('extra-scripts')
    @routes
    <script src="{{ mix('js/administracion/planteles/app.js')  }}" defer></script>
@endsection

@section('navbar-title')
    Administración - Centros de Trabajo
@endsection

@section('content')
    <app></app>
@endsection
