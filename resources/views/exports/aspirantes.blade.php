<table>
    <thead>
        <tr>
            <th>FOLIO</th>
            <th>NOMBRE</th>
            <th>SEXO</th>
            <th>FECHA_NACIMIENTO</th>
            <th>CURP</th>
            <th>CURP</th>
            <th>CURP_VALIDA</th>
            <th>CURP_HISTORICA</th>
            <th>MATRICULA</th>
            <th>EMAIL</th>
            <th>DOMICILIO</th>
            <th>TELEFONO</th>
            <th>TIENE_PAGO</th>
            <th>ENVIO_REGISTRO</th>
            <th>TIENE_PASE</th>
            <th>PROCEDENCIA_CLAVE_CENTRO_TRABAJO</th>
            <th>PROCEDENCIA_NOMBRE_CENTRO_TRABAJO</th>
            <th>FECHA_EGRESO</th>
            <th>PRIMERA_OPCION</th>
            <th>PRIMERA_OPCION_MUNICIPIO</th>
        </tr>
    </thead>
    <tbody>
        @foreach($aspirantes as $aspirante)
            <tr>
                <td>{{ $aspirante->folio }}</td>
                <td>{{ $aspirante->nombre_completo }}</td>
                <td>{{ $aspirante->sexo }}</td>
                <td>{{ $aspirante->fecha_nacimiento }}</td>
                <td>{{ $aspirante->curp }}</td>
                <td>{{ $aspirante->curp }}</td>
                <td>{{ $aspirante->curp_valida }}</td>
                <td>{{ $aspirante->curp_historica }}</td>
                <td>{{ $aspirante->matricula }}</td>
                <td>{{ $aspirante->email }}</td>
                <td>{{ $aspirante->domicilio }}</td>
                <td>{{ $aspirante->telefono }}</td>
                <td>{{ $aspirante->tiene_pago }}</td>
                <td>{{ $aspirante->envio_registro }}</td>
                <td>{{ $aspirante->con_pase }}</td>
                <td>{{ $aspirante->procedencia_clave_centro_trabajo }}</td>
                <td>{{ $aspirante->procedencia_nombre_centro_trabajo }}</td>
                <td>{{ $aspirante->fecha_egreso }}</td>
                <td>{{ $aspirante->primera_opcion }}</td>
                <td>{{ $aspirante->nombre_municipio }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
