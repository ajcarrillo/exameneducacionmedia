@extends('layouts.vuetify')

@section('extra-scripts')
    <script src="{{ mix('js/app.js') }}" defer></script>
@endsection

@section('content')
    <router-view></router-view>
@endsection
