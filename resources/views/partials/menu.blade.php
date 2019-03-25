<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if(auth()->user()->hasRole('supermario'))
            <li class="nav-item has-treeview menu">
                <a href="/telescope" class="nav-link">
                    <i class="fas fa-bug"></i>
                    <p>
                        Telescope
                    </p>
                </a>
            </li>
        @endif
        <!-----------------Cambiar contraseña------------------------------->
        <li class="nav-item has-treeview menu">
            <a href="{{ route('update.password') }}" class="nav-link">
                <i class="fas fa-key"></i>
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
    <!-----------------plantel------------------------------->
	    @if(auth()->user()->hasRole('plantel'))
		    <li class="nav-item has-treeview menu">
			    <a href="{{ route('centro-descarga.cdescarga.index') }}" class="nav-link">
                    <i class="fas fa-cloud-download-alt"></i>
				    <p>
					    Centro de descarga
				    </p>
			    </a>
		    </li>
	    @endif
    <!--------------------------endplantel---------------------->
    <!------------------------------------------------>
        <!-----------------Panel de control DEMS ------------------------------->

        @if(auth()->user()->hasRole('departamento'))
            <li class="nav-item has-treeview menu">
                <a href="{{ route('media.administracion.panelAdministracion.index') }}" class="nav-link">
                    <i class="fas fa-chart-bar"></i>
                    <p>
                        Panel de control DEMS
                    </p>
                </a>
            </li>
        @endif
    <!------------------------------------------------>
        <!-----------------Panel de control DEMS ------------------------------->
        @if(auth()->user()->hasRole(['departamento', 'subsistema']))
            <li class="nav-item has-treeview menu">
                <a href="{{ route('reportes.index') }}" class="nav-link">
                    <i class="far fa-file-alt"></i>
                    <p>
                        Reportes
                    </p>
                </a>
            </li>
        @endif
    <!------------------------------------------------>
        <!-----------------Configuración del proceso ------------------------------->
        @if(auth()->user()->hasRole('departamento'))
            <li class="nav-item has-treeview menu menu-open">
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <p>
                        Configuración del proceso
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: block">
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
            <li class="nav-item has-treeview menu menu-open">
                <a href="#" class="nav-link">
                    <i class="fas fa-briefcase"></i>
                    <p>
                        Administración
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: block">
                    <li class="nav-item">
                        <a href="{{ route('media.administracion.aspirantes.index') }}" class="nav-link">
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
                        <a href="{{ route('media.administracion.planteles.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Planteles</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('media.pagos.problema') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Problema de pagos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('media.pagos.reportes.depositos') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Reportes de pago</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('media.administracion.sedesAlternas.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Sedes alternas</p>
                        </a>
                    </li>
                    {{--<li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Subir archivos</p>
                        </a>
                    </li>--}}
                    <li class="nav-item">
                        <a href="{{ route('media.pagos.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Subir pagos</p>
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
            <li class="nav-item has-treeview menu menu-open">
                <a href="#" class="nav-link">
                    <i class="fas fa-tasks"></i>
                    <p>
                        Revisión
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: block">
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
			    <a href="{{ route('centro-descarga.cdescarga.index') }}" class="nav-link">
                    <i class="fas fa-download"></i>
				    <p>
					    Centro de descargas
				    </p>
			    </a>
		    </li>

		    <li class="nav-item has-treeview menu menu-open">
                <a href="#" class="nav-link">
                    <i class="fas fa-diagnoses"></i>
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
                    <li class="nav-item">
                        <a href="/subsistemas/especialidades" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Especialidades</p>
                        </a>
                    </li>
                </ul>
            </li>
    @endif
    <!------------------------------------------------>
    </ul>
</nav>
