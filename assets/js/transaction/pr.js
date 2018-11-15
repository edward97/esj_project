"use strict";

script = function() {
    function addData() {
        id = $(this).data("direct");

        if (id === "new") {
            window.location.href = url+"transaction/pr/act/new";
        } else {
            window.location.href = url+"transaction/pr/act/detail/"+id;
        }
    }

    function itemPo() {
        id = $(this).val();


    }

    function getItem(x) {
        id = x;

        $.ajax({
            url: url+"dashboard/search/itempo",
            type: "get",
            data: {id: id},
            success: function(data) {
                $.each(data, function(key, value) {
                    console.log(1);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data...");
            }
        });
    }

    function someEvent() {
        // add-data
        $(document).on("click", "[data-direct]", addData);
        
        // reload-table
        $(document).on("click", "#reload-data", reload_table);

        // get po item
        $(document).on("change", "#item-id", itemPo);
        $(document).on("change", "#supplier-id", getItem);

        // po-list
        $(".ui-po").autocomplete({
            source: url+"dashboard/search/po",
            minLength: 0,

            select: function(event, ui) {
                $("#supplier-id").val(ui.item.supplierid);
                getItem(ui.item.value);
            }
        }).focus(function() {
            $(this).autocomplete("search");
        });
    }

    function init() {
        someEvent();
    } return {
        init: init
    }
}();

$(document).ready(function() {
    table = $("#table-data").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": url+"transaction/pr/list",
            "type": "post",
        },
        "columnDefs": [
            {
                "targets": [0, -1],
                "orderable": false,
            },
        ],
    });
    script.init();
});
