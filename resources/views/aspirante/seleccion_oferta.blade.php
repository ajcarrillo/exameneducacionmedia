@extends('aspirante.layouts.aspirante')

@section('content')
    <app
        :mun="{{ json_encode($municipios) }}"
        :opciones="{{ json_encode($opciones) }}"
    >
    </app>
@endsection

@section('extra-scripts')
    <script src="{{ mix('js/aspirante/seleccion_oferta.js') }}"></script>
@endsection
