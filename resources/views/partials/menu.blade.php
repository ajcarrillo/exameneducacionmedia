<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-----------------Cambiar contraseña------------------------------->
        <li class="nav-item has-treeview menu">
            <a href="#" class="nav-link">
                <i></i>
                <p>
                    Cambiar contraseña
                </p>
            </a>
        </li>
        <!------------------------------------------------>
        <!-----------------Coordinación------------------------------->
        @if(auth()->user()->hasRole('cordinador'))
            <li class="nav-item has-treeview menu">
                <a href="#" class="nav-link">
                    <i></i>
                    <p>
                        Coordinación
                    </p>
                </a>
            </li>
        @endif
    <!------------------------------------------------>
        <!-----------------Panel de control DEMS ------------------------------->

        @if(auth()->user()->hasRole('departamento'))
            <li class="nav-item has-treeview menu">
                <a href="{{ route('media.administracion.panelAdministracion.index') }}" class="nav-link">
                    <i></i>
                    <p>
                        Panel de control DEMS
                    </p>
                </a>
            </li>
        @endif
    <!------------------------------------------------>
        <!-----------------Panel de control DEMS ------------------------------->
        @if(!auth()->user()->hasRole('aspirante'))
            <li class="nav-item has-treeview menu">
                <a href="{{ route('media.administracion.enlaces.index') }}" class="nav-link">
                    <i></i>
                    <p>
                        Reportes
                    </p>
                </a>
            </li>
        @endif
    <!------------------------------------------------>
        <!-----------------Configuración del proceso ------------------------------->
        @if(auth()->user()->hasRole('departamento'))
            <li class="nav-item has-treeview menu">
                <a href="#" class="nav-link">
                    <i></i>
                    <p>
                        Configuración del proceso
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('media.administracion.enlaces.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Enlaces</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('media.administracion.etapasProceso.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Etapas del proceso</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('media.administracion.configuracion.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Misceláneos</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
    <!------------------------------------------------>
        <!-----------------Administración proceso ------------------------------->
        @if(auth()->user()->hasRole('departamento') )
            <li class="nav-item has-treeview menu">
                <a href="#" class="nav-link">
                    <i></i>
                    <p>
                        Administración
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Aspirantes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('media.administracion.estudiante.buscar') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Buscar matricula</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('media.administracion.carga-documentos.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Carga de archivos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('media.administracion.responsablePlantel.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Planteles</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Sedes alternas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Subir archivos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('media.administracion.responsableSubsistema.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Subsistemas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('media.administracion.usuarios.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
    <!------------------------------------------------>
        <!-----------------Revisión ------------------------------->
        @if(auth()->user()->hasRole('departamento'))
            <li class="nav-item has-treeview menu">
                <a href="#" class="nav-link">
                    <i></i>
                    <p>
                        Revisión
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('media.administracion.revisiones.aforo.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Aforo</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('media.administracion.revisiones.ofertaEducativa.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Oferta educativa</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
    <!------------------------------------------------>
        <!-----------------Subsistema ------------------------------->
        @if(auth()->user()->hasRole('subsistema'))
            <li class="nav-item has-treeview menu">
                <a href="#" class="nav-link">
                    <i></i>
                    <p>
                        Subsistema
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('spa.subsistemas') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Planteles</p>
                        </a>
                    </li>
                </ul>
            </li>
    @endif
    <!------------------------------------------------>
    </ul>
</nav>
