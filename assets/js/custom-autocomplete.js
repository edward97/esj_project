"use strict";

$(document).ready(function() {
    $(".ui-divisi").autocomplete({
        source: url+"dashboard/search/divisi",
        minLength: 0,

        select: function(event, ui) {
            $('[name="divisi-id"]').val(ui.item.desc);
        }
    }).focus(function() {
        $(this).autocomplete("search");
    });

    $(".ui-user").autocomplete({
        source: url+"dashboard/search/user",
        minLength: 0,

        select: function(event, ui) {
            $('[name="user-id"]').val(ui.item.desc);
        }
    }).focus(function() {
        $(this).autocomplete("search");
    });

    $(".ui-permintaan").autocomplete({
        source: url+"dashboard/search/permintaan",
        minLength: 0,

        select: function(event, ui) {
            $('[name="permintaan-id"]').val(ui.item.desc);
        }
    }).focus(function() {
        $(this).autocomplete("search");
    });

    $(".ui-supplier").autocomplete({
        source: url+"dashboard/search/supplier",
        minLength: 0,

        select: function(event, ui) {
            $('[name="supplier-id"]').val(ui.item.desc);
        }
    }).focus(function() {
        $(this).autocomplete("search");
    });

    $(".ui-warehouse").autocomplete({
        source: url+"dashboard/search/warehouse",
        minLength: 0,

        select: function(event, ui) {
            $('[name="warehouse-id"]').val(ui.item.desc);
        }
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
                $("#detail-name-"+id).val(ui.item.label);
                $("#detail-uom-"+id).val(ui.item.uom);
                $("#detail-qty-"+id).val(1);
                $("#detail-rate-"+id).val(0);
                $("#detail-total-"+id).val(0);
            }
        });
    });
});
