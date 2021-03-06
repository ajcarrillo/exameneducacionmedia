const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            '@': __dirname + '/resources/js'
        },
    },
});

mix.sass('resources/sass/adminlte.scss', 'public/css')
    .sass('resources/sass/base.scss', 'public/css')
    .sass('resources/sass/blink.scss', 'public/css');

mix.js('resources/js/adminlte.js', 'public/js')
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/subsistemas/app.js', 'public/js/subsistemas')
    .js('resources/js/administracion/planteles/app.js', 'public/js/administracion/planteles')
    .js('resources/js/aspirante/registro_matricula.js', 'public/js/aspirante')
    .js('resources/js/aspirante/profile.js', 'public/js/aspirante')
    .js('resources/js/aspirante/dashboard.js', 'public/js/aspirante')
    .js('resources/js/aspirante/seleccion_oferta.js', 'public/js/aspirante')
    .js('resources/js/administracion/planteles.js', 'public/js/administracion/')
    .js('resources/js/media/administracion/pagos/problema/app.js', 'public/js/administracion/pagos/problema')
    .js('resources/js/developer_zone/services.js', 'public/js/developer_zone')
    .js('resources/js/coordinador/app.js', 'public/js/coordinador');

if (mix.inProduction()) {
    mix.version();
} else {
    mix.browserSync({
        proxy: 'exameneducacionmedia.test',
        files: [
            'app/**/*',
            'resources/**/*',
            'routes/**/*'
        ],
        browser: ['vivaldi']
    });
}

//Igna
mix.js('resources/js/media/administracion/etapas/edit.js', 'public/js/media/administracion/etapas/edit.js');
mix.js('resources/js/media/administracion/buscar_matricula/index.js', 'public/js/media/administracion/buscar_matricula/index.js');
mix.js('resources/js/aspirante/cuestionario/form_cuestionario.js', 'public/js/aspirante/cuestionario/form_cuestionario.js');
//endIgna
mix.js('resources/js/media/administracion/responsable_plantel/eliminar.js', 'public/js/media/administracion/responsable_plantel/eliminar.js');


// ANTONIO
mix.js('resources/js/media/administracion/responsable_subsistema/eliminar.js', 'public/js/media/administracion/responsable_subsistema/eliminar.js');
// END ANTONIO

mix.js('resources/js/media/administracion/carga_documento/create.js', 'public/js/media/administracion/carga_documento/create.js');
mix.js('resources/js/media/administracion/carga_documento/index_archivos.js', 'public/js/media/administracion/carga_documento/index_archivos.js');

//alvaro
mix.js('resources/js/media/administracion/oferta_educativa/index.js', 'public/js/media/administracion/oferta_educativa/index.js');
mix.js('resources/js/media/administracion/aforo/index.js', 'public/js/media/administracion/aforo/index.js');
mix.js('resources/js/administracion/panel_departamento/home.js', 'public/js/administracion/panel_departamento/home.js');
//endAlvaro


mix.js('resources/js/media/administracion/sedes_alternas/create.js', 'public/js/media/administracion/sedes_alternas/create.js');
mix.js('resources/js/media/administracion/sedes_alternas/edit.js', 'public/js/media/administracion/sedes_alternas/edit.js');
mix.js('resources/js/media/administracion/home.js', 'public/js/media/administracion/home.js');
