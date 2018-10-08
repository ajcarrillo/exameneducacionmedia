@extends('layouts.app')

@section('extra-head')
    <meta name="subsistema" content="{{ Auth::user()->subsistema->id }}">
@endsection

@section('extra-scripts')
    @routes
    <script src="{{ mix('js/subsistemas/app.js')  }}" defer></script>
@endsection

@section('navbar-title')
    {{ Auth::user()->subsistema->referencia }}
@endsection

@section('content')
    <app></app>
@endsection
