<div class="card">
    <div class="card-header">
        <h1 class="card-title">
            Opciones educativas
        </h1>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table">
            <thead>
                <tr>
                    <th>Preferencia</th>
                    <th>Plantel</th>
                    <th>Especialidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach($opciones as $opcion)
                    <tr>
                        <td scope="row">{{ $opcion->preferencia }}</td>
                        <td>{{ $opcion->ofertaEducativa->plantel->descripcion }}</td>
                        <td>{{ $opcion->ofertaEducativa->especialidad->referencia }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
