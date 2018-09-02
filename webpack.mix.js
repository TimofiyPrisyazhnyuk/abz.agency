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

mix.react('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/appStaffTree.js','public/js')
   .js('resources/assets/js/datatable.js','public/js')
   .js('resources/assets/js/bossUpdate.js','public/js')
   .sass('resources/assets/sass/appStaffTreeIndex.scss', 'public/css')
   .sass('resources/assets/sass/appListUsers.scss', 'public/css')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/font-awesome.scss', 'public/css')
   .sass('resources/assets/sass/animation.scss', 'public/css')
   .sass('resources/assets/sass/style.scss', 'public/css');
