<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @yield('extra-scripts')

        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
        @yield('extra-css')
        @yield('extra-head')
    </head>
    <body>
        <div id="app">
            <v-app>
                <v-navigation-drawer app v-model="drawer" :mini-variant.sync="mini">
                    <v-list class="pt-0" dense>
                        <v-divider></v-divider>

                        <v-list-tile
                            v-for="item in items"
                            :key="item.title"
                            @click=""
                        >
                            <v-list-tile-action>
                                <v-icon>@verbatim{{ item.icon }}@endverbatim</v-icon>
                            </v-list-tile-action>

                            <v-list-tile-content>
                                <v-list-tile-title>@verbatim{{ item.title }}@endverbatim</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>
                </v-navigation-drawer>
                <v-toolbar app>
                    <v-toolbar-side-icon @click.stop="mini = !mini"></v-toolbar-side-icon>
                    <v-toolbar-title>{{ config('app.name', 'Laravel') }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    @guest()
                        <v-toolbar-items class="hidden-sm-and-down">
                            <v-btn flat> One</v-btn>
                            <v-btn flat> Two</v-btn>
                            <v-btn flat> Three</v-btn>
                        </v-toolbar-items>
                    @else()
                        <v-toolbar-items class="hidden-sm-and-down">
                            <v-btn flat>Link One</v-btn>
                            <v-btn flat>Link Two</v-btn>
                            <v-btn flat>Link Three</v-btn>
                        </v-toolbar-items>
                    @endguest()
                </v-toolbar>
                <v-content>
                    @yield('content')
                </v-content>
                <v-footer app></v-footer>
            </v-app>
        </div>
    </body>
</html>
