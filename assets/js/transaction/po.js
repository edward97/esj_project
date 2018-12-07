"use strict";

script = function() {
    btnNew      = $("#new-data");
    btnSave     = $("#save-data");
    btnEdit     = $("#edit-data");
    btnCancel   = $("#cancel-data");
    btnDelete   = $("#delete-data");
    btnFind     = $("#find-data");

    tableBody   = $("#table-detail tbody");
    rowCount    = 1;

    // --------------------

    function splitData(data) {
        id = data.split("-");
        return id;
    }

    function formatNumber() {
        $('[name="detail-qty[]"]').number(true, 2);
        $('[name="detail-rate[]"]').number(true, 2);
        $('[name="detail-total[]"]').number(true, 2);
    }

    // enable input
    function onData() {
        $("[data-edit=0]").prop("disabled", true);
        $("[data-edit=1]").prop("disabled", false);
    }
    // disable input
    function offData() {
        $("[data-edit=0]").prop("disabled", true);
        $("[data-edit=1]").prop("disabled", true);
    }
    // add row
    function addRow() {
        html = '<tr id="row-'+rowCount+'">'
        +'<td><button type="button" style="margin-top: .4rem" data-edit="1" class="btn btn-custom btn-danger" id="remove-row"><i class="far fa-trash-alt"></i></button></td>'
        +'<td><input type="hidden" name="addr[]" value="New"><input type="text" class="form-control form-control-sm ui-item" data-edit="1" name="detail-id[]" id="detail-id-'+rowCount+'"></td>'
        +'<td><input type="text" class="form-control form-control-sm" data-edit="1" name="detail-name[]" id="detail-name-'+rowCount+'"></td>'
        +'<td><input type="text" class="form-control form-control-sm text-right" data-edit="1" name="detail-qty[]" id="detail-qty-'+rowCount+'"></td>'
        +'<td><input type="text" class="form-control form-control-sm" data-edit="0" name="detail-uom[]" id="detail-uom-'+rowCount+'"></td>'
        +'<td><input type="text" class="form-control form-control-sm text-right" data-edit="1" name="detail-rate[]" id="detail-rate-'+rowCount+'"></td>'
        +'<td><input type="text" class="form-control form-control-sm text-right" data-edit="0" name="detail-total[]" id="detail-total-'+rowCount+'"></td>'
        +'</tr>';

        tableBody.append(html);
        rowCount++;

        onData();
        formatNumber();
        checkRow();
    }
    // remove row
    function removeRow() {
        $(this).parents("tr").remove();

        grandTotalData();
        checkRow();
    }

    // disable | enable save button
    function checkRow() {
        (!$("#table-detail tbody tr").length) ? btnSave.prop("disabled", true) : btnSave.prop("disabled", false);
    }

    function newData() {
        $("#form-data")[0].reset();
        currentDate();
        tableBody.empty();
        addRow();

        $(".box-1").hide();
        $(".box-2").show();
        grandTotalData();
        checkRow();
        onData();
    }
    function saveData() {
        $("[data-edit]").prop("disabled", false);
        id = $("#po-id");

        path = (id.val() === "") ? url+"transaction/po/store" : url+"transaction/po/update";
        $.ajax({
            url: path,
            type: "post",
            data: $("#form-data").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    $(".alert").remove();
                    $(".form-control").removeClass("is-invalid").next().remove();

                    swal(data.msg, { icon: "success" });
                    id.val(data.id);

                    btnEdit = $("#edit-data").prop("disabled", false);
                    $(".box-1").show();
                    $(".box-2").hide();

                    offData();
                } else {
                    $.each(data.msg, function(key, value) {
                        html = $("#"+key);
                        html.removeClass("is-invalid").addClass(value.length > 0 ? "is-invalid" : "").next().remove();
                        html.after(value);
                    });
                    onData();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error adding/update data...");
            }
        });
    }
    function editData() {
        $(".box-1").hide();
        $(".box-2").show();

        checkRow();
        onData();
    }
    function cancelData() {
        $("#form-data")[0].reset();

        btnEdit.prop("disabled", true);
        btnDelete.prop("disabled", true);
        $(".box-1").show();
        $(".box-2").hide();

        $(".alert").remove();
        $(".form-control").removeClass("is-invalid").next().remove();

        rowCount = 1;
        tableBody.empty();
        grandTotalData();
        offData();
    }
    function deleteData() {
        id = $("#po-id").val();

        swal({
            title: "Delete Purchase Order "+ id +" ?",
            text: "You can't undo this data anymore!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((res) => {
            if (res) {
                $.ajax({
                    url: url+"transaction/po/destroy/"+id,
                    type: "post",
                    dataType: "json",
                    success: function(data) {
                        if (data.status) {
                            swal("Poof! Delete success!", { icon: "success" }).then(reload_table());
                        } else {
                            swal("Error code: "+data.msg.code, "Message: "+data.msg.message, "error");
                        }
                        cancelData();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("Error deleting data...");
                    }
                });
            }
        });
    }
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

    function detailData() {
        tableBody.empty();
        id = $(this).data("detail");

        rowCount = 1;
        $.ajax({
            url: url+"transaction/po/edit/"+id,
            type: "get",
            dataType: "json",
            success: function(data) {
                $('[name="po-id"]').val(data.po.id_po);
                $('[name="po-date"]').val(data.po.date);
                $('[name="supplier-id"]').val(data.po.id_supplier);
                $('[name="supplier-nm"]').val(data.po.nm_supplier);
                $('[name="warehouse-id"]').val(data.po.id_warehouse);
                $('[name="warehouse-nm"]').val(data.po.nm_warehouse);
                $('[name="description"]').val(data.po.description);
   
                $.each(data.po_detail, function(key, value) {
                    html = '<tr id="row-'+rowCount+'">'
                    +'<td><button type="button" style="margin-top: .4rem" data-edit="1" class="btn btn-custom btn-danger" id="remove-row"><i class="far fa-trash-alt"></i></button></td>'
                    +'<td><input type="hidden" name="addr[]" value="'+value.unq+'"><input type="text" class="form-control form-control-sm ui-item" data-edit="1" name="detail-id[]" id="detail-id-'+rowCount+'" value="'+value.id_item+'-'+value.id_size+'"></td>'
                    +'<td><input type="text" class="form-control form-control-sm" data-edit="1" name="detail-name[]" id="detail-name-'+rowCount+'" value="'+value.nm_po_item+'"></td>'
                    +'<td><input type="text" class="form-control form-control-sm text-right" data-edit="1" name="detail-qty[]" id="detail-qty-'+rowCount+'" value="'+value.qty+'"></td>'
                    +'<td><input type="text" class="form-control form-control-sm" data-edit="0" name="detail-uom[]" id="detail-uom-'+rowCount+'" value="'+value.uom+'"></td>'
                    +'<td><input type="text" class="form-control form-control-sm text-right" data-edit="1" name="detail-rate[]" id="detail-rate-'+rowCount+'" value="'+value.rate+'"></td>'
                    +'<td><input type="text" class="form-control form-control-sm text-right" data-edit="0" name="detail-total[]" id="detail-total-'+rowCount+'" value="'+(value.qty * value.rate)+'"></td>'
                    +'</tr>';

                    tableBody.append(html);
                    rowCount++;
                });
                btnEdit.prop("disabled", false);
                btnDelete.prop("disabled", false);
                grandTotalData();
                formatNumber();
                offData();
                $("#modal-data").modal("hide");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error get data...");
            }
        });
    }

    function totalData() {
        let current = $(this), q, qty, rate;
        id = splitData(current.attr("id"));
        id = id[2];

        qty = $("#detail-qty-"+id).val();
        rate = $("#detail-rate-"+id).val();
        q = qty * rate;
        $("#detail-total-"+id).val((isNaN(q) ? 0 : q));
        $("#detail-total-"+id).number(true, 2);

        grandTotalData();
    }
    function grandTotalData() {
        id = 0;

        $("#form-data :input[name='detail-total[]']").each(function() {
            id = parseFloat(id) + parseFloat($(this).val());
        });
        $("#grand-total").text((isNaN(id) ? 0 : id));
        $("#grand-total").number(true, 2);
    }

    function someEvent() {
        offData();

        // detail
        $(document).on("click", "[data-detail]", detailData);

        // add-row
        $("#add-row").on("click", addRow);
        // remove-row
        $(document).on("click", "#remove-row", removeRow);
        // refresh-data
        $("#reload-data").on("click", reload_table);

        // qty | rate
        $(document).on("input", '[name="detail-qty[]"]', totalData);
        $(document).on("input", '[name="detail-rate[]"]', totalData);

        // --------------------
        
        btnNew.on("click", newData);
        btnSave.on("click", saveData);
        btnEdit.on("click", editData);
        btnCancel.on("click", cancelData);
        btnDelete.on("click", deleteData);
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

//     functionerFormat() {
//         $("")er(true, 2);
//     }

//     function addHtml() {
//         html = '<tr id="row-'+rowCount+'">'
//         +'<td><button type="button" data-action="delete" class="btn btn-sm btn-danger queen"><i class="far fa-trash-alt"></i></button></td>'
//         +'<td><input type="hidden" name="addr[]"value="New"><input type="text" name="detail-id[]" class="form-control form-control-sm ui-item queen" id="detail-id-'+rowCount+'"></td>'
//         +'<td><input type="text" name="detail-name[]" class="form-control form-control-sm queen" id="detail-name-'+rowCount+'"></td>'
//         +'<td><input type="text" name="detail-qty[]" class="form-control form-control-sm queen" id="detail-qty-'+rowCount+'"></td>'
//         +'<td><input type="text" name="detail-rate[]" class="form-control form-control-sm queen" id="detail-rate-'+rowCount+'"></td>'
//         +'<td><input type="text" name="detail-total[]" class="form-control form-control-sm-total" id="detail-total-'+rowCount+'" disabled></td>'
//         +'</tr>';

//         tableBody.append(html);
//         rowCount++;

//         btnSave();
//        erFormat();
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
//                     +'<td><input type="text" name="detail-qty[]" class="form-control form-control-sm queen" id="detail-qty-'+rowCount+'" value="'+value.qty+'"></td>'
//                     +'<td><input type="text" name="detail-rate[]" class="form-control form-control-sm queen" id="detail-rate-'+rowCount+'" value="'+value.rate+'"></td>'
//                     +'<td><input type="text" name="detail-total[]" class="form-control form-control-sm-total" id="detail-total-'+rowCount+'" value="'+val+'" disabled></td>'
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

//                erFormat();
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
//         $("#detail-total-"+id)er(true, 2);

//         hitungGrandTotal();
//     }

//     function hitungGrandTotal() {
//         id = 0;
//         $("#form-data :input").each(function() {
//             if ($(this).hasClass(-total")) {
//                 id = parseFloat(id)+parseFloat($(this).val());
//             }
//         });
//         $("#grandtotal").text(id);
//         $("#grandtotal")er(true, 2);
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
