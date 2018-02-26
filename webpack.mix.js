let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js').version()
    .sass('resources/assets/sass/app.scss', 'public/css').version();

mix.sass('resources/assets/sass/home.scss', 'public/css').version();




// mix.styles([
//     'resources/assets/css/app.css',
//     'resources/assets/css/admin.css'
// ], 'public/css/style.css');

//
// mix.scripts([
//     'resources/assets/js/libs/jquery.js',
//     'resources/assets/js/libs/bootstrap.js',
//     'resources/assets/js/libs/metisMenu.js',
//     'resources/assets/js/libs/sb-admin-2.js',
//     'resources/assets/js/libs/scripts.js'
// ], 'public/js/libs.js');
