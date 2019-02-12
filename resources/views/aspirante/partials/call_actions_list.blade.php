<ul class="list-unstyled call-to-action">
    <li>
        <a href="{{ route('aspirante.profile') }}"
           class="btn bg-primary btn-sm">
            Editar perfil
        </a>
    </li>
    <li>
        <a href="/aspirantes/opciones-educativas"
           class="btn btn-primary btn-sm">Opciones educativas</a>
    </li>
    @if($hasRevision)
        @if($revision->efectuado)
            @if(!$hasPaseAlExamen)
                <li>
                    <a href="{{ route('aspirante.generar.pase') }}"
                       onclick="event.preventDefault(); document.getElementById('generar-pase-form').submit();"
                       class="btn btn-primary btn-sm">Genera pase al examen</a>
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
                       class="btn btn-primary btn-sm">Descargar pase al examen</a>
                </li>
            @endif
        @endif
    @else
        @if($hasInformacionCompleta)
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
    @endif
</ul>
