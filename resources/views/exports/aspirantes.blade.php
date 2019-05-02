<table>
    <thead>
        <tr>
            <th>FOLIO</th>
            <th>NOMBRE</th>
            <th>CURP</th>
            <th>EMAIL</th>
            <th>DOMICILIO</th>
            <th>TIENE_PAGO</th>
            <th>ENVIO_REGISTRO</th>
            <th>TIENE_PASE</th>
            <th>PRIMERA_OPCION</th>
            <th>PRIMERA_OPCION_MUNICIPIO</th>
        </tr>
    </thead>
    <tbody>
        @foreach($aspirantes as $aspirante)
            <tr>
                <td>{{ $aspirante->folio }}</td>
                <td>{{ $aspirante->nombre_completo }}</td>
                <td>{{ $aspirante->curp }}</td>
                <td>{{ $aspirante->email }}</td>
                <td>{{ $aspirante->domicilio }}</td>
                <td>{{ $aspirante->tiene_pago }}</td>
                <td>{{ $aspirante->envio_registro }}</td>
                <td>{{ $aspirante->con_pase }}</td>
                <td>{{ $aspirante->primera_opcion }}</td>
                <td>{{ $aspirante->nombre_municipio }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
