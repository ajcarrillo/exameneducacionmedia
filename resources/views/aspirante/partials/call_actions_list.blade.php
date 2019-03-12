<ul class="list-unstyled call-to-action">
    <li>
        <a href="{{ route('aspirante.profile') }}"
           class="btn bg-primary btn-sm btn-block">
            1 - Editar perfil
        </a>
    </li>
    <li>
        <a href="/aspirantes/captura-cuestionario"
           class="btn btn-primary btn-sm btn-block">2 - Cuestionario CENEVAL</a>
    </li>
    <li>
        <a href="/aspirantes/opciones-educativas"
           class="btn btn-primary btn-sm btn-block">3 - Opciones educativas</a>
    </li>
    <li>
        <a href="{{ route('centro-descarga.cdescarga.index') }}"
           class="btn btn-success btn-sm btn-block">Centro de descargas</a>
    </li>
    @if($hasRevision)
        @if($revision->efectuado)
            @if(!$hasPaseAlExamen)
                <li>
                    <a href="{{ route('aspirante.generar.pase') }}"
                       onclick="event.preventDefault(); document.getElementById('generar-pase-form').submit();"
                       class="btn btn-primary btn-sm blink">Genera pase al examen</a>
                    <form id="generar-pase-form"
                          action="{{ route('aspirante.generar.pase') }}"
                          method="post"
                          style="display: none">
                        @csrf
                    </form>
                </li>
            @else
                <li>
                    <a href=""
                       class="btn btn-primary btn-sm blink">Descargar pase al examen</a>
                </li>
            @endif
        @else
            <li>
                <a href=""
                   class="btn btn-primary btn-sm blink">Descarga ficha de depósito</a>
            </li>
        @endif
    @else
        @if($hasInformacionCompleta)
            <li>
                <a class="btn btn-primary btn-sm blink" href="{{ route('aspirante.enviar.registro') }}"
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
    @endif
</ul>
