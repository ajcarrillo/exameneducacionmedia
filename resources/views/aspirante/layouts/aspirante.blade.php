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
        @yield('extra-css')
    </head>
    <body>

        <div class="wrapper" id="app">
            @yield('content')
        </div>

        <script src="{{ mix('js/adminlte.js') }}"></script>
        <script type="text/javascript">
            window.clone = function (obj) {
                return JSON.parse(JSON.stringify(obj));
            }
        </script>
        @yield('extra-scripts')
    </body>
</html>
