$(document).ready(function() {
    "use strict";
    
    // ui-autocomplete
    $(".ui-divisi").autocomplete({
        source: url+"dashboard/search/divisi",

        select: function(event, ui) {
            $('[name="divisi-id"]').val(ui.item.label);
        }
    });

    $(".ui-supplier").autocomplete({
        source: url+"dashboard/search/supplier",

        select: function(event, ui) {
            $('[name="supplier-id"]').val(ui.item.label);
        }
    });

    $(".ui-warehouse").autocomplete({
        source: url+"dashboard/search/warehouse",

        select: function(event, ui) {
            $('[name="warehouse-id"]').val(ui.item.label);
        }
    });
});
