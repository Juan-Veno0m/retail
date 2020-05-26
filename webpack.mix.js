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

 mix.scripts([
     'node_modules/jquery/dist/jquery.slim.min.js',
     'node_modules/bootstrap/dist/js/bootstrap.min.js',
     'resources/js/main.js'
 ], 'public/js/all.js').version()
    .sass('resources/sass/app.scss', 'public/css');
