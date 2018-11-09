"use strict";

$(document).ready(function() {
    tableBody = $("#table-detail tbody");
    
    table = $("#table-data").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": url+"transaction/po/list",
            "type": "post",
        },
        "columnDefs": [
            {
                "targets": [0, -1],
                "orderable": false,
            },
        ],
    });

    // add-data
    $(document).on("click", "[data-add]", function() {
        sv_method = "create";

        // call function
        addModal();
        tableBody.empty();

        rowCount = 1;
        appHtml("add", "");

        // show-modal
        $("#modal-data").modal("show");
    });

    // edit-data
    $(document).on("click", "[data-edit]", function() {
        id = $(this).data("edit");

        sv_method = id;

        // call function
        editModal();

        $.ajax({
            url: url+"transaction/po/edit/"+id,
            type: "get",
            dataType: "json",
            success: function(data) {
                $('[name="po-id"]').val(data.po.id_po);
                $('[name="po-date"]').val(data.po.date);
                $('[name="supplier-id"]').val(data.po.id_supplier);
                $('[name="warehouse-id"]').val(data.po.id_warehouse);
                $('[name="description"]').val(data.po.description);

                appHtml("edit", id);

                // show-modal
                $("#modal-data").modal("show");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data...");
            }
        });
    });

    // delete-data
    $(document).on("click", "[data-delete]", function() {
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
                    url: url+"transaction/po/delete/"+id,
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
    });

    // save-data
    $(document).on("click", "#save-data", function() {
        id = $(this);
        id.attr("disabled", true).text("Saving...");

        // url
        path = (sv_method === "create") ? url+"transaction/po/add" : url+"transaction/po/update";

        $.ajax({
            url: path,
            type: "post",
            data: $("#form-data").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    $(".alert").remove();
                    $(".form-control").removeClass("is-invalid").next().remove();
                    $("#info").prepend(data.msg);

                    if (sv_method !== "create") {
                        appHtml("edit", sv_method);
                    }
                    reload_table();
                } else {
                    $.each(data.msg, function(key, value) {
                        html = $("#"+key);
                        html.removeClass("is-invalid").addClass(value.length > 0 ? "is-invalid" : "").next().remove();
                        html.after(value);
                    });
                }
                id.attr("disabled", false).text("Save");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error adding/update data...");
            }
        });
    });

    // event reload table
    $(document).on("click", "#reload-data", function() {
        reload_table();
    });

    $.datetimepicker.setLocale('en');
    $('#po-date').datetimepicker({
        mask:'9999/19/39 29:59'
    });

    // -----------
    // detail item
    // -----------
    $(document).on("click", "[data-action]", function() {
        id = $(this).data('action');

        if (id === 'add') {
            $("#save-data").prop("disabled", false);
            appHtml("add", "");
        } else {
            $(this).parents("tr").remove();
        }
        btnSave();
    });

    function appHtml(act, id) {
        if (act === "add") {
            html = '<tr id="row-'+rowCount+'">'
            +'<td><a href="javascript:;" data-action="delete" class="form-control form-control-sm text-danger"><i class="far fa-trash-alt"></i></a></td>'
            +'<td><input type="hidden" name="addr[]"value="New"><input type="text" name="detail-id[]" class="form-control form-control-sm ui-item" id="detail-id-'+rowCount+'"></td>'
            +'<td><input type="text" name="detail-name[]" class="form-control form-control-sm" id="detail-name-'+rowCount+'"></td>'
            +'<td><input type="number" name="detail-qty[]" class="form-control form-control-sm" id="detail-qty-'+rowCount+'"></td>'
            +'<td><input type="text" name="detail-rate[]" class="form-control form-control-sm" id="detail-rate-'+rowCount+'"></td>'
            +'</tr>';

            tableBody.append(html);
            rowCount++;

            btnSave();
        } else {
            tableBody.empty();

            $.ajax({
                url: url+"transaction/po/edit/"+id,
                type: "get",
                dataType: "json",
                success: function(data) {
                    rowCount = 1;
                    $.each(data.po_detail, function(key, value) {
                        html = '<tr id="row-'+rowCount+'">'
                        +'<td><a href="javascript:;" data-action="delete" class="form-control form-control-sm text-danger"><i class="far fa-trash-alt"></i></a></td>'
                        +'<td><input type="hidden" name="addr[]" value="'+value.unq+'"><input type="text" name="detail-id[]" class="form-control form-control-sm ui-item" id="detail-id-'+rowCount+'" value="'+value.id_item+'-'+value.id_size+'"></td>'
                        +'<td><input type="text" name="detail-name[]" class="form-control form-control-sm" id="detail-name-'+rowCount+'" value="'+value.nm_po_item+'"></td>'
                        +'<td><input type="number" name="detail-qty[]" class="form-control form-control-sm" id="detail-qty-'+rowCount+'" value="'+value.qty+'"></td>'
                        +'<td><input type="text" name="detail-rate[]" class="form-control form-control-sm" id="detail-rate-'+rowCount+'" value="'+value.rate+'"></td>'
                        +'</tr>';
        
                        tableBody.append(html);
                        rowCount++;
                    });
                    btnSave();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error get data...");
                }
            });
        }
    }
});
