const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/sistem.js', 'public/js');
mix.js('resources/assets/js/koperasi.js', 'public/js');
mix.js('resources/assets/js/bank.js', 'public/js');
mix.js('resources/assets/js/nasabah.js', 'public/js');
   // .sass('resources/assets/sass/app.scss', 'public/css');
