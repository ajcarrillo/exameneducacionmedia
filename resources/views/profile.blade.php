@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h2>
                    {{ get_user_full_name() }}
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @if ($hasImpersonate)
                    <a class="btn btn-primary" href="{{ route('logout.as.user') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-as-user-form').submit();">
                        Regresar a mi sesión
                    </a>
                    <form id="logout-as-user-form" action="{{ route('logout.as.user') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <span>Salir</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
