require('./bootstrap');
// Importa il file CSS di DataTables

window.$ = window.jQuery = require('jquery');
import Chart from 'chart.js';
require('jquery-ui-dist/jquery-ui.min.js');
require( 'datatables.net-bs4' );
require('datatables.net-buttons-bs4');
require('datatables.net-buttons/js/buttons.colVis');
require('datatables.net-buttons/js/buttons.flash');
require('datatables.net-buttons/js/buttons.html5');
require('datatables.net-buttons/js/buttons.print');
import 'datatables.net-responsive-bs';
import 'datatables.net-responsive-bs/css/responsive.bootstrap.css';
require('pdfmake/build/pdfmake.min');
require('pdfmake/build/vfs_fonts');
require('jszip/dist/jszip.min');
import flatpickr from "flatpickr";
require('datatables.net-colreorder-bs4');




$(document).ready( function () {

    $("#data_lavorazione").datepicker({ dateFormat: 'dd-mm-yy' });


    $('#semenza').autocomplete({
        source: "/autocomplete",
        minLength: 2,
        select: function(event, ui) {
            $('#semenza').val(ui.item.value);
        }
    });

    $('#table_colture').DataTable({
        "paging": true,
        "ordering": true,
        "colReorder": true,
        responsive: true,
        "info": true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Italian.json"
        }
    });

    $('#tabella_raccolta').DataTable({
        "paging": true,
        "ordering": true,
        "colReorder": true,
        "info": true,
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Italian.json"
        }
    });

    $('#table_lavorazioni').DataTable({
        "paging": true,
        "ordering": true,
        "colReorder": true,
        responsive: true,
        "info": true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Italian.json"
        }
    });


} );


