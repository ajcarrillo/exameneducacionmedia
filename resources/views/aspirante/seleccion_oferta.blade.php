@extends('aspirante.layouts.aspirante')

@section('content')
    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col d-flex">
                <div class="alert alert-info align-self-stretch" role="alert">
                ¡Es importante que antes que envíes tus opciones educativas estés seguro de ellas, ya que una vez que las envíes no podrás modificarlas!
            </div>
            </div>
            <div class="col d-flex">
                <div class="alert alert-info align-self-stretch" role="alert">
                *Por cada plantel, se podrá elegir máximo 3 especialidades.
            </div>
            </div>
            <div class="col d-flex">
                <div class="alert alert-info align-self-stretch" role="alert">
                *La selección de las opciones educativas será responsabilidad exclusiva del aspirante y de sus padres o tutores
            </div>
            </div>
            <div class="col d-flex">
                <div class="alert alert-info align-self-stretch" role="alert">
                Recuerda: la asignación de tu plantel dependerá del espacio disponible en cada uno de los planteles y el resultado obtenido en tu examen.
            </div>
            </div>




        </div>
    </div>
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

@section('extra-css')
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
    <style>
        .alert {
            font-size: 1.3rem;
        }
    </style>
@endsection
