<table>
    <thead>
        <tr>
            <th>Municipio</th>
            <th>Subsistema</th>
            <th>Localidad</th>
            <th>Plantel</th>
            <th>proceso_completo</th>
            <th>sin_pase</th>
            <th>sin_registro</th>
            <th>con_registro_sin_pago</th>
            <th>demanda</th>
            <th>oferta</th>
            <th>aforo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($aspirantes as $aspirante)
            <tr>
                <td>{{ $aspirante->nombre_municipio }}</td>
                <td>{{ $aspirante->subsistema }}</td>
                <td>{{ $aspirante->nombre_localidad }}</td>
                <td>{{ $aspirante->plantel }}</td>
                <td>{{ $aspirante->proceso_completo }}</td>
                <td>{{ $aspirante->sin_pase }}</td>
                <td>{{ $aspirante->sin_registro }}</td>
                <td>{{ $aspirante->con_registro_sin_pago }}</td>
                <td>{{ $aspirante->demanda }}</td>
                <td>{{ $aspirante->oferta }}</td>
                <td>{{ $aspirante->aforo }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
