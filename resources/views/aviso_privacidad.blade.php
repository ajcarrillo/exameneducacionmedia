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
                En cumplimiento a Ley General de Protección de Datos Personales en Posesión de los
                Sujetos Obligados y la Ley de Protección de Datos Personales en Posesión de Sujetos
                Obligados de Quintana Roo, los Servicios Educativos de Quintana Roo, con domicilio en
                la avenida Insurgentes, número 600, colonia Gonzalo Guerrero, código postal 77020, de
                la Ciudad de Chetumal, Quintana Roo, en su calidad de Sujeto Obligado informa que es el
                responsable del tratamiento de los Datos Personales que nos proporcione, los cuales
                serán protegidos de conformidad a lo dispuesto por la citada Ley y demás normatividad
                que resulte aplicable. Los Datos Personales que recabamos de Usted, los utilizaremos
                principalmente para el control interno, la elaboración de informes sobre el servicio
                brindado y con fines estadísticos; para generar solicitud de examen de ingreso al Nivel
                Medio Superior, asumiendo la obligación de cumplir con las medidas legales y de
                seguridad suficientes para proteger los Datos Personales que se hayan recabado. Para
                mayor detalle consulte, nuestro Aviso de Privacidad Integral en: <a href="http://qroo.gob.mx/seq">http://qroo.gob.mx/seq</a>
                en la sección “Datos Personales”. <a href="{{ Request::server('HTTP_REFERER', '/') }}">Regresar</a>
            </p>
            <div class="row justify-content-center mt-3">
                <div class="col-3">
                    <img src="{{ asset('img/secretaria-seq.png') }}" class="img-fluid" alt="SEQ">
                </div>
            </div>
        </div>
    </body>
</html>
