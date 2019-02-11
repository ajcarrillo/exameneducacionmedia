<ul class="list-unstyled call-to-action">
    <li>
        <a href="/aspirantes/opciones-educativas"
           class="btn btn-primary btn-sm">Opciones educativas</a>
    </li>
    @if($hasRevision)
        @if($revision->efectuado)
            @if(!$hasPaseAlExamen)
                <li>
                    <a href=""
                       class="btn btn-primary btn-sm">Genera pase al examen</a>
                </li>
            @else
                <li>
                    <a href=""
                       class="btn btn-primary btn-sm">Descargar pase al examen</a>
                </li>
            @endif
        @endif
    @else
        <li>
            <a class="btn btn-primary btn-sm" href="{{ route('aspirante.enviar.registro') }}"
               onclick="event.preventDefault();
                document.getElementById('enviar-registro-form').submit();">
                Enviar Registro
            </a>
            <form id="enviar-registro-form"
                  action="{{ route('aspirante.enviar.registro') }}"
                  method="POST"
                  style="display: none;">
                @csrf
            </form>
        </li>
    @endif
</ul>
