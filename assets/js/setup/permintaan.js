"use strict";

$(document).ready(function() {
    table = $("#table-data").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": url+"setup/permintaan/list",
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

        // show-modal
        $("#modal-data").modal("show");
    });

    // edit-data
    $(document).on("click", "[data-edit]", function() {
        sv_method = "update";
        id = $(this).data("edit");

        // call function
        editModal();

        $.ajax({
            url: url+"setup/permintaan/edit/"+id,
            type: "get",
            dataType: "json",
            success: function(data) {
                $('[name="permintaan-id"]').val(data.id_permintaan);
                $('[name="permintaan-nm"]').val(data.nm_permintaan);

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
                    url: url+"setup/permintaan/delete/"+id,
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
        id.prop("disabled", true).text("Saving...");

        // url
        path = (sv_method === "create") ? url+"setup/permintaan/add" : url+"setup/permintaan/update";

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

                    reload_table();
                } else {
                    $.each(data.msg, function(key, value) {
                        html = $("#"+key);
                        html.removeClass("is-invalid").addClass(value.length > 0 ? "is-invalid" : "").next().remove();
                        html.after(value);
                    });
                }
                id.prop("disabled", false).text("Save");
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
});
