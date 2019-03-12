<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>SIEM</title>

        @auth
            <meta name="api-token" content="{{ Auth::user()->api_token }}">
            <meta name="token" content="{{ Auth::user()->jarvis_user_access_token }}">
        @endauth

        <title>{{ config('app.name', 'Laravel') }}</title>
        @yield('extra-head')

        <link rel="stylesheet" href="{{ mix('css/adminlte.css') }}">
        <link rel="stylesheet" href="{{ asset('css/blink.css') }}">
        @yield('extra-css')
        <style>
            body {
                height: 100vh !important;
            }
        </style>
    </head>
    <body>
        @include('partials.logos_banner')
        <div class="bg-primary">
            <div class="container py-4">
                <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="mb-0">Bienvenido<br> {{ get_user_full_name() }} <br> Folio
                            CENEVAL: {{ get_aspirante()->folio }}</h5>

                    </div>
                    @if ($hasImpersonate)
                        <a class="btn bg-white" href="{{ route('logout.as.user') }}"
                           style="color: #1f2d3d!important"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-as-user-form').submit();">
                            Regresar a mi sesión
                        </a>
                        <form id="logout-as-user-form" action="{{ route('logout.as.user') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a class="btn bg-white"
                           style="color: #1f2d3d!important"
                           href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Salir
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endif
                </div>

            </div>
        </div>
        <div class="wrapper" id="app">
            @yield('content')
        </div>
        @routes
        <script src="{{ mix('js/adminlte.js') }}"></script>
        <script type="text/javascript">
            window.clone = function (obj) {
                return JSON.parse(JSON.stringify(obj));
            }
        </script>

        @yield('extra-scripts')
    </body>
</html>
