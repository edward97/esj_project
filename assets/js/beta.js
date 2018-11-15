"use strict";
let id, id_parent, val, table, sv_method, path, html, script, tableBody, rowCount, actSave, actEdit;

$(document).ready(function() {
    // sign-in
    $(document).on("submit", "form.form-login", function(e) {
        e.preventDefault();
        $("#log-check").prop("disabled", true).find("#txt").text("Cheking...");
        path = url+"welcome/login_act";

        $.ajax({
            url: path,
            type: "post",
            data: $(".form-login").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.status === '1') {
                    swal({
                        title: "Login Success!",
                        text: "Welcome!",
                        icon: "success",
                        buttons: false,
                        timer: 2000
                    }).then(
                        function() {
                            window.location.href = url+"dashboard";
                        }
                    );
                }
                else if(data.status === '2') {
                    $(".form-control").removeClass("is-invalid").next().remove();
                    swal("Oops!", data.msg, "error");
                } else {
                    $.each(data.msg, function(key, value) {
                        html = $("#"+key);
                        html.removeClass("is-invalid").addClass(value.length > 0 ? "is-invalid" : "").next().remove();
                        html.after(value);
                    });
                }
                $("#log-check").prop("disabled", false).find("#txt").text("SIGN IN");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error checking login...");
            }
        });
    });

    // sign-out
    $(document).on("click", "#sign-out", function(e) {
        e.preventDefault();

        swal({
            title: "Are you sure?",
            text: ":(",
            icon: "warning",
            buttons: true
        }).then((res) => {
            if (res) {
                swal("Poof! Sign-out success!", { icon: "success" }).then(function() {window.location.href = url+"welcome/logout";});
            }
        });
    });

    // custom-datetimepicker
    $.datetimepicker.setLocale('id');
    $('[data-type="date"]').datetimepicker({
        minDate: '01/01/2018',
        maxDate: '31/12/2030',
        formatDate: 'd/m/Y',
        format: "d-M-Y H:i",
        value: '0'
    });
});

// ---------- custom ----------
function addModal() {
    $(".modal-title").text("Add Data").parent().removeClass("bg-primary").addClass("bg-success");
    $(".form-control").removeClass("is-invalid").next().remove();
    $(".alert").remove();

    $("#form-data")[0].reset();
    $("#save-data").removeClass("btn-primary").addClass("btn-success");
}

function editModal() {
    $(".modal-title").text("Edit Data").parent().removeClass("bg-success").addClass("bg-primary");
    $(".form-control").removeClass("is-invalid").next().remove();
    $(".alert").remove();

    $("#form-data")[0].reset();
    $("#save-data").removeClass("btn-success").addClass("btn-primary");
}

// reload table
function reload_table() {
    $("#table-data").DataTable().ajax.reload(null, false);
}
// ---------- end custom ----------
