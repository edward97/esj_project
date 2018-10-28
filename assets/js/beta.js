$(document).ready(function() {
    // variable
    let link, error;

    // login-background
    $.backstretch(url+"assets/img/login-bg.jpg", { speed: 500 });

    // login
    $(document).on("click", "#sign-in", function() {
        // clear content
        $("div").removeClass("has-error");
        $(".text-danger").remove();

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
                    $(".login-wrap").prepend('<span class="text-danger">'+data.msg+'</span>');
                } else {
                    $.each(data.msg, function(key, value) {
                        error = $("#"+key);
                        error.closest("div.form-group").addClass(value.length > 0  ? "has-error" : '');
                        error.after(value);
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error checking login...");
            }
        });
        $(this).attr("disabled", false);
    });
});