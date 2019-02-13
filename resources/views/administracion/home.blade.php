@extends('layouts.app')

@section('extra-head')

    <link rel="stylesheet" href="{{ mix('css/adminlte.css') }}">
    @yield('extra-css')

@endsection

@section('navbar-title')
    Departamento - Contenido
@endsection

@section('content')
    <div class="content">
        Contenido
    </div>
@endsection
