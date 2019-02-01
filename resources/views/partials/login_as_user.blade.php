@if ($hasImpersonate)
    <a class="dropdown-item">
        <p class="text-center">Estás usando la cuenta de</p>
        <p class="text-center"><b>{{ $currentUser->nombre }}</b></p>
    </a>
    <div class="dropdown-divider"></div>
    @if ($originalUser)
        <a class="dropdown-item">
            <p class="text-center">Estas logeado como</p>
            <p class="text-center"><b>{{ $originalUser->nombre }}</b></p>
        </a>
    @endif
    <div class="dropdown-divider"></div>
    <a class="dropdown-item dropdown-footer" href="{{ route('logout.as.user') }}"
       onclick="event.preventDefault();
                                                     document.getElementById('logout-as-user-form').submit();">
        Regresar a mi sesión
    </a>
    <form id="logout-as-user-form" action="{{ route('logout.as.user') }}" method="POST" style="display: none;">
        @csrf
    </form>
@else
    <a class="dropdown-item dropdown-footer" href="{{ route('logout') }}"
       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
        Salir
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

@endif
