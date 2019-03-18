<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ asset('img/iconoseyc.png') }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/blink.css') }}">
        <style>
            body {
                font-family: 'Nunito', 'serif';
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 0.875rem;
                font-weight: 600;
                letter-spacing: .1rem;
                text-transform: uppercase;
            }

            .register > a {
                text-decoration: underline;
                font-size: 1rem !important;
            }

            @media (min-width: 576px) {
                #descargables > a {
                    width: 100%;
                }
            }

            @media (min-width: 768px) {
                #descargables > a {
                    width: 33.333%;
                }
            }

            @media (min-width: 992px) {

            }

            @media (min-width: 1200px) {

            }


        </style>
    </head>
    <body>
        <div class="container-fluid" id="app">
            <main class="d-flex flex-column">
                <div class="logos-gobierno text-center mt-3 mb-5">
                    <img
                        class="img-fluid"
                        src="{{ asset('img/secretaria-seq.png') }}"
                        alt="Gobierno del Estado de Quintana Roo - SEQ">
                </div>
                <div class="logos-siem text-center">
                    <img
                        style="width: 100%; max-width: 600px; margin: 0 auto"
                        class="d-block"
                        src="{{ asset('img/paenms.png') }}"
                        alt="Secretaría de Educación de Quintana Roo">
                    <img
                        style="width: 100%; max-width: 600px; margin: 0 auto"
                        class="d-block"
                        src="{{ asset('img/lineas_colores.gif') }}"
                        alt="Departamento de Educación Media Superior">
                </div>
                <div class="about text-center mt-5 mb-3">
                    <h2
                        class=""
                        style="color: #938e94; font-size: 3rem; font-weight: 600;">Proceso de Asignación de Espacios</h2>
                    <h2 class="mb-5"
                        style="color: #666a6d; font-size: 3rem; font-weight: 600;">Nivel Medio Superior</h2>
                    <h3
                        class="mb-0"
                        style="color: #666a6d"><b>REGISTRO: {{ get_etapa('registro')->fecha_apertura }} al {{ get_etapa('registro')->fecha_cierre }}</b></h3>

                </div>
                @guest
                    @if(is_etapa_registro())
                        <div class="register mt-3 links d-flex flex-column flex-sm-row justify-content-center">
                            <a href="/aspirantes/registro-matricula"
                               class="text-center mb-3"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="Aspirantes que ESTUDIAN o ESTUDIARON algún grado en el estado de Quintana Roo"
                            >
                                Registro alumnos de Quintana Roo
                            </a>
                            <a href="/aspirantes/registro-externo"
                               class="text-center mb-3">
                                <span>Registro alumnos de otros estados</span>
                            </a>
                            <a href="/aspirantes/registro-externo"
                               class="text-center mb-3">
                                <span>Registro alumnos extranjeros</span>
                            </a>
                        </div>
                    @endif
                @endguest
                <div class="mt-3 d-flex flex-column flex-sm-row justify-content-center">
                    <a href="{{ route('login') }}" class="btn btn-info btn-lg blink">
                        Entrar
                    </a>
                </div>

                <div class="information mt-3 mb-3">
                    <h3 class="text-center mb-0">
                        <a href="">
                            Convocatoria PAENMS 2019
                        </a>
                    </h3>

                    <div class="mt-3 links d-flex flex-column flex-sm-row justify-content-center">
                        <a class="text-center mb-3" href="http://qroo.gob.mx/seq/preparatoria-abierta-quintana-roo">Preparatoria abierta</a>
                        <a class="text-center mb-3" href="http://www.prepaenlinea.sep.gob.mx/">Preparatoria en línea</a>
                        <a class="text-center mb-3" href="http://www.facebook.com/paenmsqroo">Asesorías y dudas</a>
                    </div>

                    <div id="descargables" class="mt-3 links d-flex flex-column flex-sm-row justify-content-around">
                        <a class="text-center mb-3 flex-fill" href="{{ asset('descargas/guia_de_estudios.pdf') }}" target="_blank">Guía de estudios EXANI-I CENEVAL</a>
                        <a class="text-center mb-3 flex-fill" href="http://siem.seq.gob.mx/static/media/catalogo_opciones_educativas.pdf">Catálogo de preparatorias públicas en
                            Quintana Roo</a>
                        <a class="text-center mb-3 flex-fill" href="http://siem.seq.gob.mx/static/media/Preparatoria_Abierta_del_Colegio_de_Bachilleres_del_Estado_de_Quintana_Roo.pdf">Preparatoria
                            Abierta en el Colegio de Bachilleres</a>
                    </div>
                </div>
            </main>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
    </body>
</html>
