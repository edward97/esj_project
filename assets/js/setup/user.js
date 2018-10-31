$(document).ready(function() {
    'use strict';
    let id, table, sv_method, path, html;
    
    // table
    table = $("#table-data").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": url+"setup/user/list",
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
    $(document).on("click", "#add-data", function() {
        sv_method = "create";

        $(".text-danger").remove();
        $(".modal-title").text("Add User");

        $("#form-data")[0].reset();
        $("#info").empty();
        $("#save-data").removeClass("btn-primary").addClass("btn-success");

        // show modal
        $("#modal-data").modal("show");
    });

    // save-data
    $(document).on("click", "#save-data", function() {
        $(this).attr("disabled", true).text("Saving...");

        path = (sv_method === "create") ? url+"setup/user/add" : url+"setup/user/update";

        $.ajax({
            url: path,
            type: "post",
            data: $("#form-data").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    $(".text-danger").remove();
                    $("#info").addClass("text-success").text(data.msg);

                    reload_table();
                } else {
                    $.each(data.msg, function(key, value) {
                        html = $("#"+key);

                        html.closest("div.form-group")
                        .removeClass("has-error")
                        .addClass(value.length > 0 ? "has-error" : "")
                        .find(".text-danger").remove();

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
});
