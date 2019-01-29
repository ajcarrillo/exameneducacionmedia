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

mix.sass('resources/sass/adminlte.scss', 'public/css')
    .sass('resources/sass/base.scss', 'public/css');

mix.js('resources/js/adminlte.js', 'public/js')
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/subsistemas/app.js', 'public/js/subsistemas')
    .js('resources/js/administracion/planteles/app.js', 'public/js/administracion/planteles')
    .js('resources/js/aspirante/registro_matricula.js','public/js/aspirante')
    .js('resources/js/aspirante/profile.js','public/js/aspirante');

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
//endIgna
