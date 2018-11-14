"use strict";

$(document).ready(function() {
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

    $(document).on("focus", ".ui-item", function() {
        id = $(this).attr("id").split("-");
        id = id[id.length-1];

        $(this).autocomplete({
            source: url+"dashboard/search/item",
            minLength: 1,

            select: function(event, ui) {
                // $("#detail-id-"+id).prop("disabled", true);
                $("#detail-name-"+id).val(ui.item.label);
                $("#detail-qty-"+id).val(0);
                $("#detail-rate-"+id).val(0);
                $("#detail-total-"+id).val(0);
            }
        });
    });
});
