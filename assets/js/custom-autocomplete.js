$(document).ready(function() {
    "use strict";
    
    $(".ui-divisi").autocomplete({
        source: url+"dashboard/search/divisi",
        minLength: 0,
    }).focus(function() {
        $(this).autocomplete("search");
    });

    $(".ui-supplier").autocomplete({
        source: url+"dashboard/search/supplier",
        minLength: 0,
    }).focus(function() {
        $(this).autocomplete("search");
    });

    $(".ui-warehouse").autocomplete({
        source: url+"dashboard/search/warehouse",
        minLength: 0,
    }).focus(function() {
        $(this).autocomplete("search");
    });
});

// old style
// $(".ui-supplier").autocomplete({
//     source: url+"dashboard/search/supplier",

//     select: function(event, ui) {
//         $('[name="supplier-id"]').val(ui.item.label);
//     }
// });