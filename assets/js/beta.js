$(document).ready(function() {
    'use strict';
    // variable
    let link, html;

    // tinymce
    tinymce.init({
        // selector: 'textarea',
        selector: '.txt',
        height: '200',
    });

    // sign-in
    $(document).on("click", "#sign-in", function() {
        link = url+"welcome/login_act";
        $(this).attr("disabled", true);

        $.ajax({
            url: link,
            type: "post",
            data: $(".form-login").serialize(),
            dataType: "json",
            success: function(data) {
                if (data.status === '1') {
                    window.location.href = url+"dashboard";
                }
                else if(data.status === '2') {
                    $(".form-control").removeClass("is-invalid").next().remove();
                    alert(data.msg);
                } else {
                    $.each(data.msg, function(key, value) {
                        html = $("#"+key);
                        html.removeClass("is-invalid").addClass(value.length > 0 ? "is-invalid" : "").next().remove();
                        html.after(value);
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error checking login...");
            }
        });
        $(this).attr("disabled", false);
    });

    // sign-out
    $(document).on("click", "#sign-out", function(e) {
        e.preventDefault();
        
        if (confirm("Are you sure want to sign-out?")) {
            window.location.href = url+"welcome/logout";
        }
    });
});
