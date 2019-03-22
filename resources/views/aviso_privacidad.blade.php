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
    </head>
    <body>
        <div class="container-fluid" id="app">
            <h2 class="text-center">Aviso de privacidad</h2>
            <p>
                Conforme a lo establecido en la Ley General de Protección de Datos Personales en Posesión de los Sujetos Obligados y la Ley de Protección de Datos Personales en Personales en Posesión de Sujetos Obligados en Quintana Roo, los datos personales recabados serán protegidos y se incorporarán y tratarán en el sistema de datos del proceso de asignación de la Secretaría de Educación. Serán utilizados únicamente para los propósitos del proceso de asignación, así como para fines estadísticos, de investigación y planeación. (Consulta el Aviso de Privacidad en:
                <a href="http://qroo.gob.mx/seq">http://qroo.gob.mx/seq</a> en la sección  “Datos personales”). <a href="{{ Request::server('HTTP_REFERER', '/') }}">Regresar</a>
            </p>
            <div class="row justify-content-center mt-3">
                <div class="col-3">
                    <img src="{{ asset('img/secretaria-seq.png') }}" class="img-fluid" alt="SEQ">
                </div>
            </div>
        </div>
    </body>
</html>
