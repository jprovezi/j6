/**
 * Template Name: Hexzy - Bootstrap 4 Admin Dashboard
 * Datatable
 */

!function($) { 
    "use strict";

    var DataTable = function() {
        this.$dataTableButtons = $("#datatable-buttons")
    };
    DataTable.prototype.createDataTableButtons = function() {
        0 !== this.$dataTableButtons.length && this.$dataTableButtons.DataTable({
            dom: "Bfrtip",
            buttons: [{
                extend: "copy",
                className: "btn-success"
            }, {
                extend: "csv"
            }, {
                extend: "excel"
            }, {
                extend: "pdf"
            }, {
                extend: "print"
            }],
            responsive: !0,
            language: {
                lengthMenu: 'Mostrar _MENU_ Linhas por página',
                zeroRecords: 'Nenhum registro encontrato.',
                info: 'Página _PAGE_ de _PAGES_ [ Total _MAX_ ]',
                infoEmpty: 'Nenhum registro disponível',
                infoFiltered: '(Filtrado de _MAX_ total registros)',
                search: 'Pesquisar:',
                paginate: {
                    previous: "Anterior",
                    next: "Próximo"
                }
            },
            pageLength: 25,
            order: [[0, 'desc']],
        });
    },
    DataTable.prototype.init = function() {
        //creating table with button
        this.createDataTableButtons();
    },
    //init
    $.DataTable = new DataTable, $.DataTable.Constructor = DataTable
}(window.jQuery),

//initializing
function ($) {
    "use strict";
    $.DataTable.init();
}(window.jQuery);