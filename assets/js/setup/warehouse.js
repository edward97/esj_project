$(document).ready(function() {
    "use strict";
    let id, table, sv_method, path, html;
    
    // table
    table = $("#table-data").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": url+"setup/warehouse/list",
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

        // change-class
        $(".modal-title").text("Add Data").parent().removeClass("bg-primary").addClass("bg-success");
        $(".form-control").removeClass("is-invalid").next().remove();
        $(".alert").remove();

        // change-id
        $("#form-data")[0].reset();
        $("#save-data").removeClass("btn-primary").addClass("btn-success");

        // show-modal
        $("#modal-data").modal("show");
    });

    // edit-data
    $(document).on("click", "[data-edit]", function() {
        sv_method = "update";
        id = $(this).data("edit");

        // change-class
        $(".modal-title").text("Edit Data").parent().removeClass("bg-success").addClass("bg-primary");
        $(".form-control").removeClass("is-invalid").next().remove();
        $(".alert").remove();

        // change-id
        $("#form-data")[0].reset();
        $("#save-data").removeClass("btn-success").addClass("btn-primary");

        $.ajax({
            url: url+"setup/warehouse/edit/"+id,
            type: "get",
            dataType: "json",
            success: function(data) {
                $('[name="warehouse-id"]').val(data.id_warehouse);
                $('[name="warehouse-nm"]').val(data.nm_warehouse);

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
                    url: url+"setup/warehouse/delete/"+id,
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
        $(this).attr("disabled", true).text("Saving...");

        // url
        path = (sv_method === "create") ? url+"setup/warehouse/add" : url+"setup/warehouse/update";

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
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error adding/update data...");
            }
        });
        $(this).attr("disabled", false).text("Save");
    });

    // event reload table
    $(document).on("click", "#reload-data", function() {
        reload_table();
    });

    // reload table
    function reload_table() {
        table.ajax.reload(null, false);
    }
});
