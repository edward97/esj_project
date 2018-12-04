"use strict";

script = function() {
    btnNew      = $("#new-data");
    btnSave     = $("#save-data");
    btnEdit     = $("#edit-data");
    btnCancel   = $("#cancel-data");
    btnFind     = $("#find-data");

    tableBody   = $("#table-detail tbody");
    rowCount    = 1;

    function findData() {
        table = $("#table-data").DataTable({
            "destroy": true,
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

        $("#modal-data").modal("show");
    }

    function someEvent() {
        // beta.js
        currentDate();

        btnFind.on("click", findData);
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



// script = function() {
//     actEdit = $("#edit-data");
//     actSave = $("#save-data");
//     sv_method = $('[name="po-id"]').val();
//     tableBody = $("#table-detail tbody");
//     rowCount = 1;

//     function btnSave() {
//         (!$("#table-detail tbody tr").length) ? actSave.prop("disabled", true) : actSave.prop("disabled", false);
//     }

//     function numberFormat() {
//         $(".numb").number(true, 2);
//     }

//     function addHtml() {
//         html = '<tr id="row-'+rowCount+'">'
//         +'<td><button type="button" data-action="delete" class="btn btn-sm btn-danger queen"><i class="far fa-trash-alt"></i></button></td>'
//         +'<td><input type="hidden" name="addr[]"value="New"><input type="text" name="detail-id[]" class="form-control form-control-sm ui-item queen" id="detail-id-'+rowCount+'"></td>'
//         +'<td><input type="text" name="detail-name[]" class="form-control form-control-sm queen" id="detail-name-'+rowCount+'"></td>'
//         +'<td><input type="text" name="detail-qty[]" class="form-control form-control-sm queen numb" id="detail-qty-'+rowCount+'"></td>'
//         +'<td><input type="text" name="detail-rate[]" class="form-control form-control-sm queen numb" id="detail-rate-'+rowCount+'"></td>'
//         +'<td><input type="text" name="detail-total[]" class="form-control form-control-sm numb numb-total" id="detail-total-'+rowCount+'" disabled></td>'
//         +'</tr>';

//         tableBody.append(html);
//         rowCount++;

//         btnSave();
//         numberFormat();
//     }

//     function editHtml() {
//         rowCount = 1;

//         $.ajax({
//             url: url+"transaction/po/edit/"+sv_method,
//             type: "get",
//             dataType: "json",
//             success: function(data) {
//                 $('[name="po-id"]').val(data.po.id_po);
//                 $('[name="po-date"]').val(data.po.date);
//                 $('[name="supplier-id"]').val(data.po.id_supplier);
//                 $('[name="warehouse-id"]').val(data.po.id_warehouse);
//                 $('[name="description"]').val(data.po.description);
    
//                 $.each(data.po_detail, function(key, value) {
//                     val = value.qty * value.rate;

//                     html = '<tr id="row-'+rowCount+'">'
//                     +'<td><button type="button" data-action="delete" class="btn btn-sm btn-danger queen"><i class="far fa-trash-alt"></i></button></td>'
//                     +'<td><input type="hidden" name="addr[]" value="'+value.unq+'"><input type="text" name="detail-id[]" class="form-control form-control-sm ui-item queen" id="detail-id-'+rowCount+'" value="'+value.id_item+'-'+value.id_size+'"></td>'
//                     +'<td><input type="text" name="detail-name[]" class="form-control form-control-sm queen" id="detail-name-'+rowCount+'" value="'+value.nm_po_item+'"></td>'
//                     +'<td><input type="text" name="detail-qty[]" class="form-control form-control-sm queen numb" id="detail-qty-'+rowCount+'" value="'+value.qty+'"></td>'
//                     +'<td><input type="text" name="detail-rate[]" class="form-control form-control-sm queen numb" id="detail-rate-'+rowCount+'" value="'+value.rate+'"></td>'
//                     +'<td><input type="text" name="detail-total[]" class="form-control form-control-sm numb numb-total" id="detail-total-'+rowCount+'" value="'+val+'" disabled></td>'
//                     +'</tr>';
    
//                     tableBody.append(html);
//                     rowCount++;
//                 });
//                 hitungGrandTotal();

//                 $("#form-data :input").each(function() {
//                     if ($(this).hasClass("queen")) {
//                         $(this).prop("disabled", true);
//                     }
//                 });
//                 actEdit.prop("disabled", false);

//                 numberFormat();
//             },
//             error: function(jqXHR, textStatus, errorThrown) {
//                 alert("Error get data...");
//             }
//         });
//     }

//     function addData() {
//         id = $(this).data("direct");

//         if (id === "new") {
//             window.location.href = url+"transaction/po/act/new";
//         } else {
//             window.location.href = url+"transaction/po/act/detail/"+id;
//         }
//     }

//     function editData() {
//         $(this).prop("disabled", true);

//         $("#form-data :input").each(function() {
//             id = $(this);

//             if (id.hasClass("queen")) {
//                 $(this).prop("disabled", false);
//             }
//         });
//     }

//     function deleteData() {
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
//                     url: url+"transaction/po/delete/"+id,
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
//     }

//     function saveData() {
//         path = (sv_method === "") ? url+"transaction/po/add" : url+"transaction/po/update";

//         $.ajax({
//             url: path,
//             type: "post",
//             data: $("#form-data").serialize(),
//             dataType: "json",
//             success: function(data) {
//                 if (data.status) {
//                     $(".alert").remove();
//                     $(".form-control").removeClass("is-invalid").next().remove();

//                     if (sv_method === "") {
//                         swal(data.msg, { icon: "success" }).then(function() {window.location.href = url+"transaction/po/act/detail/"+data.id;});
//                     } else {
//                         tableBody.empty();
//                         editHtml();

//                         swal(data.msg, { icon: "success" });
//                     }
//                 } else {
//                     $.each(data.msg, function(key, value) {
//                         html = $("#"+key);
//                         html.removeClass("is-invalid").addClass(value.length > 0 ? "is-invalid" : "").next().remove();
//                         html.after(value);
//                     });
//                 }
//             },
//             error: function(jqXHR, textStatus, errorThrown) {
//                 alert("Error adding/update data...");
//             }
//         });
//     }

//     function actRow() {
//         id = $(this).data('action');

//         if (id === 'add') {
//             addHtml();
//         } else {
//             $(this).parents("tr").remove();
//             btnSave();
//         }
//         hitungGrandTotal();
//     }

//     function getId(data) {
//         id = data.split("-");
//         return id[2];
//     }

//     function hitungTotal() {
//         let current = $(this), q, qty, rate;

//         id = getId(current.attr("id"));

//         qty = $("#detail-qty-"+id).val();
//         rate = $("#detail-rate-"+id).val();

//         q = qty * rate;
//         $("#detail-total-"+id).val(q);
//         $("#detail-total-"+id).number(true, 2);

//         hitungGrandTotal();
//     }

//     function hitungGrandTotal() {
//         id = 0;
//         $("#form-data :input").each(function() {
//             if ($(this).hasClass("numb-total")) {
//                 id = parseFloat(id)+parseFloat($(this).val());
//             }
//         });
//         $("#grandtotal").text(id);
//         $("#grandtotal").number(true, 2);
//     }

//     function someEvent() {
//         if (uri === "new") {
//             actEdit.prop("disabled", true);
//             addHtml();
//         } else if(uri !== "new" && uri !== "") {
//             editHtml();
//         }

//         // add-data
//         $(document).on("click", "[data-direct]", addData);

//         // edit-data
//         actEdit.on("click", editData);

//         // delete-data
//         $(document).on("click", "[data-delete]", deleteData);

//         // save-data
//         actSave.on("click", saveData);

//         // reload-table
//         $(document).on("click", "#reload-data", reload_table);

//         // add-row
//         $(document).on("click", "[data-action]", actRow);

//         // qty | rate
//         $(document).on("input", '[name="detail-qty[]"]', hitungTotal);
//         $(document).on("input", '[name="detail-rate[]"]', hitungTotal);
//     }

//     function init() {
//         someEvent();
//     } return {
//         init: init
//     }
// }();

// $(document).ready(function() {
//     table = $("#table-data").DataTable({
//         "processing": true,
//         "serverSide": true,
//         "order": [],
//         "ajax": {
//             "url": url+"transaction/po/list",
//             "type": "post",
//         },
//         "columnDefs": [
//             {
//                 "targets": [0, -1],
//                 "orderable": false,
//             },
//         ],
//     });
//     script.init();
// });
