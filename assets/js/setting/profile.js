"use strict";

script = function() {
    btnSave = $("#save-data");
    btnEdit = $("#edit-data");
    btnCancel = $("#cancel-data");
    $('[data-en="1"]').prop("disabled", true);

    function getData() {
        $.get(url+"setting/profile/list", function(data) {
            data = JSON.parse(data);

            $('[name="user-id"]').val(data.id_user);
            $('[name="user-nm"]').val(data.nm_user);
            $('[name="divisi-nm"]').val(data.nm_divisi);
            $('[name="divisi-id"]').val(data.id_divisi);
        });
    }

    function saveData() {
        $.ajax({
            url: url+"setup/user/update",
            type: "post",
            data: $("#form-data").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    $(".form-control").removeClass("is-invalid").next().remove();

                    btnSave.prop("disabled", true);
                    btnEdit.prop("disabled", false);
                    btnCancel.prop("disabled", true);
                    $('[data-en="1"]').prop("disabled", true);
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

    function editData() {
        btnSave.prop("disabled", false);
        btnEdit.prop("disabled", true);
        btnCancel.prop("disabled", false);
        $('[data-en="1"]').prop("disabled", false);
    }

    function cancelData() {
        $(".form-control").removeClass("is-invalid").next().remove();

        btnSave.prop("disabled", true);
        btnEdit.prop("disabled", false);
        btnCancel.prop("disabled", true);
        $('[data-en="1"]').prop("disabled", true);

        $("#form-data")[0].reset();
        getData();
    }

    function someEvent() {
        getData();

        btnSave.on("click", saveData);
        btnEdit.on("click", editData);
        btnCancel.on("click", cancelData);
    }

    function init() {
        someEvent();
    } return {
        init: init
    }
}();

$(function() {
    script.init();
});


// $(document).ready(function() {

//     // edit-data
//     $(document).on("click", "[data-edit]", function() {
//         sv_method = "update";
//         id = $(this).data("edit");

//         // call function
//         editModal();

//         $.ajax({
//             url: url+"setup/user/edit/"+id,
//             type: "get",
//             dataType: "json",
//             success: function(data) {
//                 $('[name="user-id"]').val(data.id_user);
//                 $('[name="user-nm"]').val(data.nm_user);
//                 $('[name="divisi-id"]').val(data.id_divisi);

//                 // show-modal
//                 $("#modal-data").modal("show");
//             },
//             error: function(jqXHR, textStatus, errorThrown) {
//                 alert("Error get data...");
//             }
//         });
//     });

//     // delete-data
//     $(document).on("click", "[data-delete]", function() {
//         id = $(this).data('delete');
        
//         swal({
//             title: "Are you sure want to delete this data?",
//             text: "You cant undo this data anymore!",
//             icon: "warning",
//             buttons: true,
//             dangerMode: true,
//         }).then((res) => {
//             if (res) {
//                 $.ajax({
//                     url: url+"setup/user/delete/"+id,
//                     type: "post",
//                     dataType: "json",
//                     success: function(data) {
//                         if (data.status) {
//                             swal("Poof! Delete success!", { icon: "success" }).then(reload_table());
//                         } else {
//                             swal("Error code: "+data.msg.code, "Message: "+data.msg.message, "error");
//                         }
//                     },
//                     error: function(jqXHR, textStatus, errorThrown) {
//                         alert("Error deleting data...");
//                     }
//                 });
//             }
//         });
//     });

//     // save-data
//     $(document).on("click", "#save-data", function() {
//         id = $(this);
//         id.prop("disabled", true).text("Saving...");

//         // url
//         path = url+"setup/user/add";

//         $.ajax({
//             url: path,
//             type: "post",
//             data: $("#form-data").serialize(),
//             dataType: "json",
//             success: function(data) {
//                 if (data.status) {
//                     $(".alert").remove();
//                     $(".form-control").removeClass("is-invalid").next().remove();
//                     $("#info").prepend(data.msg);

//                     reload_table();
//                 } else {
//                     $.each(data.msg, function(key, value) {
//                         html = $("#"+key);
//                         html.removeClass("is-invalid").addClass(value.length > 0 ? "is-invalid" : "").next().remove();
//                         html.after(value);
//                     });
//                 }
//                 id.prop("disabled", false).text("Save");
//             },
//             error: function(jqXHR, textStatus, errorThrown) {
//                 alert("Error adding/update data...");
//             }
//         });
//     });

//     // event reload table
//     $(document).on("click", "#reload-data", function() {
//         reload_table();
//     });
// });
