@extends('layouts.vuetify')

@section('extra-head')
    <meta name="subsistema" content="{{ Auth::user()->subsistema->id }}">
@endsection

@section('extra-scripts')
    @routes
    <script src="{{ mix('js/subsistemas/app.js') }}" defer></script>
@endsection

@section('app')
    <div id="app">
        <app :title="{{ json_encode($subsistema) }}" :items="items" :user="{{ json_encode(Auth::user()) }}">
            <router-view></router-view>
        </app>
    </div>
@endsection
