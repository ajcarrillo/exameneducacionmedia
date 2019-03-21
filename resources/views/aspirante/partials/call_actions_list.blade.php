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
    <li>
        <a href="{{ route('update.password') }}"
           class="btn btn-success btn-sm btn-block">Actualizar contraseña</a>
    </li>
    @if($hasRevision)
        @if($revision->efectuado)
            @if(!$hasPaseAlExamen)
                <li>
                    <button class="btn btn-primary btn-sm blink"
                            onclick="this.setAttribute('disabled', 'true'); this.innerHTML = 'Por favor espere...'; document.getElementById('generar-pase-form').submit();"
                            type="button"
                    >Generar pase al examen
                    </button>

                    <form id="generar-pase-form"
                          action="{{ route('aspirante.generar.pase') }}"
                          method="post"
                          style="display: none">
                        @csrf
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ route('aspirante.paseExamen', get_aspirante()->id) }}"
                       target="_blank"
                       class="btn btn-primary btn-sm blink">Descargar pase al examen</a>
                </li>
            @endif
        @else
            <li>
                <a href="{{ route('aspirante.fichaPago', get_aspirante()->id) }}"
                   target="_blank"
                   class="btn btn-primary btn-sm blink">Descarga ficha de depósito</a>
            </li>
        @endif
    @else
        @if($hasInformacionCompleta)
            <li>
                <button class="btn btn-primary btn-sm blink"
                        onclick="this.setAttribute('disabled', 'true'); this.innerHTML = 'Por favor espere...'; document.getElementById('enviar-registro-form').submit();"
                        type="button"
                >Enviar registro
                </button>
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
