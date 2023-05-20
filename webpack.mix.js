const mix = require('laravel-mix');
const $ = require('jquery');
const Chart = require('chart.js');
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


mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .js('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js', 'public/js')
    .js('node_modules/chart.js/dist/chart.js', 'public/js')
    .copy('node_modules/chart.js/dist/chart.js', 'public/js')
    .css('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css', 'public/css')
    .copy('node_modules/jquery-ui-dist/jquery-ui.min.js', 'public/js')
    .copy('node_modules/jquery-ui-dist/jquery-ui.min.css', 'public/css')
    .copy('node_modules/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css', 'public/css/buttons.bootstrap4.min.css')
    .copy('node_modules/datatables.net-buttons/js/buttons.colVis.min.js', 'public/js/buttons.colVis.min.js')
    .copy('node_modules/datatables.net-buttons/js/buttons.flash.min.js', 'public/js/buttons.flash.min.js')
    .copy('node_modules/datatables.net-buttons/js/buttons.html5.min.js', 'public/js/buttons.html5.min.js')
    .copy('node_modules/datatables.net-buttons/js/buttons.print.min.js', 'public/js/buttons.print.min.js')
    .copy('node_modules/pdfmake/build/pdfmake.min.js', 'public/js/pdfmake.min.js')
    .copy('node_modules/pdfmake/build/vfs_fonts.js', 'public/js/vfs_fonts.js')
    .copy('node_modules/jszip/dist/jszip.min.js', 'public/js/jszip.min.js')
.scripts([
        'node_modules/jquery/dist/jquery.js',
], 'public/js/jquery.js')
    .sourceMaps();
