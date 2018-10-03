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

mix.js('resources/js/adminlte.js', 'public/js');

if (mix.inProduction()) {
    mix.version();
} else {
    mix.browserSync({
        proxy: 'exameneducacionmedia.test',
        files: [
            'app/**/*',
            'resources/**/*',
            'routes/**/*'
        ]
    });
}

