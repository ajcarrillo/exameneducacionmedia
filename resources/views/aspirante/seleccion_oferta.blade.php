@extends('aspirante.layouts.aspirante')

@section('extra-css')
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
@endsection

@section('content')
    <app
        :mun="{{ json_encode($municipios) }}"
        :opciones="{{ json_encode($opciones) }}"
        :escuelas="{{ json_encode($planteles) }}"
    >
    </app>
@endsection

@section('extra-scripts')
    <script src="{{ mix('js/aspirante/seleccion_oferta.js') }}"></script>
@endsection
