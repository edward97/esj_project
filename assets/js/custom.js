jQuery(function ($) {
    'use strict';
    // variable
    let x;
    let themes = "chiller-theme ice-theme cool-theme light-theme";
    let bgs = "bg1 bg2 bg3 bg4";

    // add active class on current active page
    $("a.active").closest("div.sidebar-submenu")
    .css('display', 'block')
    .closest("li.sidebar-dropdown")
    .addClass('active');
    
    // Dropdown menu
    $(".sidebar-dropdown > a").click(function () {
        $(".sidebar-submenu").slideUp(200);
        if ($(this).parent().hasClass("active")) {
            $(".sidebar-dropdown").removeClass("active");
            $(this).parent().removeClass("active");
        } else {
            $(".sidebar-dropdown").removeClass("active");
            $(this).next(".sidebar-submenu").slideDown(200);
            $(this).parent().addClass("active");
        }
    });

    // close sidebar 
    $("#close-sidebar").click(function () {
        $(".page-wrapper").removeClass("toggled");
    });

    //show sidebar
    $("#show-sidebar").click(function () {
        $(".page-wrapper").addClass("toggled");
    });

    //switch between themes 
    $('[data-theme]').click(function () {
        x = $(this).data('theme');

        $('[data-theme]').removeClass("selected");
        $(this).addClass("selected");

        $.post(url+'dashboard/theme/bg_color', {name: x}, function(data, status) {
            if (data) {
                $('.page-wrapper').removeClass(themes);
                $('.page-wrapper').addClass(x);
            } else {
                alert('Error Change Color Theme...');
            }
        });
    });

    // switch between background images
    $('[data-bg]').click(function () {
        x = $(this).data('bg');

        $('[data-bg]').removeClass("selected");
        $(this).addClass("selected");

        $.post(url+'dashboard/theme/bg_img', {name: x}, function(data, status) {
            if (data) {
                $('.page-wrapper').removeClass(bgs);
                $('.page-wrapper').addClass(x);   
            } else {
                alert('Error Change Background Theme...');
            }
        });
    });

    // toggle background image
    $("#toggle-bg").change(function (e) {
        e.preventDefault();
        x = ($(this).is(':checked')) ? 1 : 0;

        $.post(url+'dashboard/theme/bg_status', {name: x}, function(data, status) {
            $('.page-wrapper').toggleClass("sidebar-bg");
        });
    });

    //custom scroll bar is only used on desktop
    if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $(".sidebar-content").mCustomScrollbar({
            axis: "y",
            autoHideScrollbar: true,
            scrollInertia: 300
        });
        $(".sidebar-content").addClass("desktop");

    }
});