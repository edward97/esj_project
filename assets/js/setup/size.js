$(document).ready(function() {
    "use strict";
    let id, id_parent, table, sv_method, path, html;

    id_parent = $("#id-parent").text();
    
    // table
    table = $("#table-data").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": url+"setup/size/list/"+id_parent,
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
        $('[name="item-id"]').val(id_parent);
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
            url: url+"setup/size/edit/"+id,
            type: "get",
            dataType: "json",
            success: function(data) {
                $('[name="item-id"]').val(id_parent);
                $('[name="size-id"]').val(data.id_size);
                $('[name="size-nm"]').val(data.nm_size);

                // show-modal
                $("#modal-data").modal("show");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data...");
            }
        });
    });

    // delete-data
    $(document).on("click", "[data-delete]", function(e) {
        e.preventDefault();
        id = $(this).data('delete');

        if (confirm("Are you sure want to delete this?")) {
            $.ajax({
                url: url+"setup/size/delete/"+id,
                type: "post",
                dataType: "json",
                success: function(data) {
                    if (data.status) {
                        reload_table();
                    } else {
                        alert('Error code: '+data.msg.code+'\nMessage: '+data.msg.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error deleting data...");
                }
            });
        }
    });

    // save-data
    $(document).on("click", "#save-data", function() {
        $(this).attr("disabled", true).text("Saving...");

        // url
        path = (sv_method === "create") ? url+"setup/size/add" : url+"setup/size/update";

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