let id, table, sv_method, path, html;

$(document).ready(function() {
    // table




    // create
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
});