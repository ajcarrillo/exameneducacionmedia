<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Notifación de pases automáticos</title>
    </head>
    <body>

        <p>Total de aspirantes con pago sin pase: {{ $totalAspirantes }}</p>
        <p>Total de pases generados: {{ $generados }}</p>

        <table>
            <thead>
                <tr>
                    <th>Planteles sin aforo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($planteles as $plantel)
                    <tr>
                        <td>{{ $plantel }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
