"use strict";

script = function() {
    actEdit = $("#edit-data");
    actSave = $("#save-data");
    sv_method = $('[name="pr-id"]').val();
    tableBody = $("#table-detail tbody");
    rowCount = 1;

    function btnSave() {
        (!$("#table-detail tbody tr").length) ? actSave.prop("disabled", true) : actSave.prop("disabled", false);
    }

    function numberFormat() {
        $(".numb").number(true, 2);
    }

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

        val = $('#item-list [value="' + id + '"]').data('value');
        $("#item-nm").val(val);

        val = $('#item-list [value="' + id + '"]').data('qty');
        $("#item-qty").val(val);

        val = $('#item-list [value="' + id + '"]').data('rate');
        $("#item-rate").val(val);

        val = $('#item-list [value="' + id + '"]').data('id');
        $("#po-id-detail").val(val);
    }

    function getItem(x) {
        id = x;
        $("#item-list").empty();
        $("#item-id").val('');
        $("#item-nm").val('');
        $("#item-qty").val('');
        $("#item-rate").val('');

        $.ajax({
            url: url+"transaction/pr/search/itempo",
            type: "get",
            data: {id: id},
            dataType: "json",
            success: function(data) {
                $.each(data, function(key, value) {
                    html = '<option data-id="'+value.id_po_detail+'" data-qty="'+value.qty+'" data-value="'+value.nm_item+'-'+value.nm_size+'" data-rate="'+value.rate+'" value="'+value.id_item+'-'+value.id_size+'">';

                    $("#item-list").append(html);
                });
                $("#item-id").prop("disabled", false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data...");
            }
        });
    }

    function hitungGrandTotal() {
        id = 0;
        $("#form-data :input").each(function() {
            if ($(this).hasClass("numb-total")) {
                id = parseFloat(id)+parseFloat($(this).val());
            }
        });
        $("#grandtotal").text(id);
        $("#grandtotal").number(true, 2);
    }

    function addHtml() {
        let a, b, c, d, e, f;
        a = $("#item-id").val();
        b = $("#item-nm").val();
        c = $("#item-qty").val();
        d = $("#item-rate").val();
        e = $("#po-id-detail").val();

        f = c * d;

        html = '<tr id="row-'+rowCount+'">'
        +'<td><button type="button" data-action="delete" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button></td>'
        +'<td><input type="hidden" name="addr[]" value="'+e+'"><input type="text" name="detail-id[]" class="form-control-plaintext form-control-sm ui-item" id="detail-id-'+rowCount+'" value="'+a+'" readonly></td>'
        +'<td><input type="text" name="detail-name[]" class="form-control-plaintext form-control-sm" id="detail-name-'+rowCount+'" value="'+b+'" readonly></td>'
        +'<td><input type="text" name="detail-qty[]" class="form-control-plaintext form-control-sm numb" id="detail-qty-'+rowCount+'" value="'+c+'" readonly></td>'
        +'<td><input type="text" name="detail-rate[]" class="form-control-plaintext form-control-sm numb" id="detail-rate-'+rowCount+'" value="'+d+'" readonly></td>'
        +'<td><input type="text" name="detail-total[]" class="form-control-plaintext form-control-sm numb numb-total" id="detail-total-'+rowCount+'" value="'+f+'" readonly></td>'
        +'</tr>';
        rowCount++;

        tableBody.append(html);

        numberFormat();
    }

    function editHtml() {
        rowCount = 1;

        $.ajax({
            url: url+"transaction/pr/edit/"+sv_method,
            type: "get",
            dataType: "json",
            success: function(data) {
                $('[name="po-id"]').val(data.pr.id_po);
                $('[name="pr-date"]').val(data.pr.date);
                $('[name="supplier-id"]').val(data.pr.id_supplier);
                $('[name="warehouse-id"]').val(data.pr.id_warehouse);
                $('[name="description"]').val(data.pr.description);
                
                $.each(data.pr_detail, function(key, value) {
                    html = '<tr id="row-'+rowCount+'">'
                    +'<td><button type="button" data-action="delete" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button></td>'
                    +'<td><input type="hidden" name="addr[]" value="'+value.id_po_detail+'"><input type="text" name="detail-id[]" class="form-control-plaintext form-control-sm ui-item" id="detail-id-'+rowCount+'" value="'+value.id_item+'-'+value.id_size+'" readonly></td>'
                    +'<td><input type="text" name="detail-name[]" class="form-control-plaintext form-control-sm" id="detail-name-'+rowCount+'" value="'+value.nm_po_item+'" readonly></td>'
                    +'<td><input type="text" name="detail-qty[]" class="form-control-plaintext form-control-sm numb" id="detail-qty-'+rowCount+'" value="'+value.pr_qty+'" readonly></td>'
                    +'<td><input type="text" name="detail-rate[]" class="form-control-plaintext form-control-sm numb" id="detail-rate-'+rowCount+'" value="'+value.rate+'" readonly></td>'
                    +'<td><input type="text" name="detail-total[]" class="form-control-plaintext form-control-sm numb numb-total" id="detail-total-'+rowCount+'" value="'+(value.pr_qty*value.rate)+'" readonly></td>'
                    +'</tr>';
    
                    tableBody.append(html);
                    rowCount++;
                });

                $("#form-data :input").each(function() {
                    if ($(this).hasClass("queen")) {
                        $(this).prop("disabled", true);
                    }
                });

                hitungGrandTotal();
                numberFormat();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data...");
            }
        });
    }

    function actData() {
        id = $(this).data("action");
        
        if (id === "add") {
            addHtml();

            $("#item-id").val('');
            $("#item-nm").val('');
            $("#item-qty").val('');
            $("#item-rate").val('');
            $("#po-id-detail").val('');
        } else if(id === "delete") {
            $(this).parents("tr").remove();
        } else {
            alert("Error Action!");
        }

        hitungGrandTotal();
    }

    function saveData() {
        path = (sv_method === "") ? url+"transaction/pr/add" : url+"transaction/pr/update";

        $.ajax({
            url: path,
            type: "post",
            data: $("#form-data").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    $(".alert").remove();
                    $(".form-control").removeClass("is-invalid").next().remove();

                    if (sv_method === "") {
                        swal(data.msg, { icon: "success" }).then(function() {window.location.href = url+"transaction/pr/act/detail/"+data.id;});
                    } else {
                        tableBody.empty();
                        editHtml();

                        swal(data.msg, { icon: "success" });
                    }
                } else {
                    $.each(data.msg, function(key, value) {
                        html = $("#"+key);
                        html.removeClass("is-invalid").addClass(value.length > 0 ? "is-invalid" : "").next().remove();
                        html.after(value);
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error adding/update data...");
            }
        });
    }

    function deleteData() {
        id = $(this).data('delete');

        swal({
            title: "Are you sure want to delete this data?",
            text: "You cant undo this data anymore!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((res) => {
            if (res) {
                $.ajax({
                    url: url+"transaction/pr/delete/"+id,
                    type: "post",
                    dataType: "json",
                    success: function(data) {
                        if (data.status) {
                            swal("Poof! Delete success!", { icon: "success" }).then(reload_table());
                        } else {
                            swal("Error code: "+data.msg.code, "Message: "+data.msg.message, "error");
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("Error deleting data...");
                    }
                });
            }
        });
    }

    function someEvent() {
        if (uri === "new") {
            actEdit.prop("disabled", true);
        } else if(uri !== "new" && uri !== "") {
            editHtml();
        }

        // add-data
        $(document).on("click", "[data-direct]", addData);

        // data-action
        $(document).on("click", "[data-action]", actData);

        // delete-data
        $(document).on("click", "[data-delete]", deleteData);
        
        // reload-table
        $(document).on("click", "#reload-data", reload_table);

        // save-data
        actSave.on("click", saveData);

        // get po item
        $(document).on("change", "#item-id", itemPo);

        // po-list
        $(".ui-po").autocomplete({
            source: url+"dashboard/search/po",
            minLength: 0,

            select: function(event, ui) {
                $("#supplier-id").val(ui.item.supplierid);
                $("#warehouse-id").val(ui.item.warehouseid);
                getItem(ui.item.value);
            }
        }).focus(function() {
            $(this).autocomplete("search");
        });

        numberFormat();
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
