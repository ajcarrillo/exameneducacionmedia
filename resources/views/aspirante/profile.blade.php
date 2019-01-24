@extends('aspirante.layouts.aspirante')

@section('content')
    <app
        :asp="{{ json_encode($aspirante) }}"
        :paises="{{ json_encode($paises) }}"
        :entidades="{{ json_encode($entidades) }}"
        :municipios="{{ json_encode($municipios) }}"
    ></app>
@endsection

@section('extra-scripts')
    @routes
    <script src="{{ mix('js/aspirante/profile.js') }}"></script>
@endsection
