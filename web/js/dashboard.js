const controller = window.location.pathname.split('/')[5];
var lastSlash = location.href.lastIndexOf('/');           
var parentUrl = location.href.slice(0, lastSlash+1);

$(function() {
    $(".sidebar-dropdown > a").click(function() {
        $(".sidebar-submenu").slideUp(200);
        if (
            $(this)
            .parent()
            .hasClass("active")
        ) {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .parent()
                .removeClass("active");
        } else {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .next(".sidebar-submenu")
                .slideDown(200);
            $(this)
                .parent()
                .addClass("active");
        }
    });

    $("#close-sidebar").click(function() {
        $(".page-wrapper").removeClass("toggled");
    });
    $("#show-sidebar").click(function() {
        if ($(".page-wrapper").hasClass('toggled')) {
            $(".page-wrapper").removeClass('toggled');
        } else {
            $(".page-wrapper").addClass("toggled");
        }
    });

    $('.toggle-menu').click(function() {
        $('.exo-menu').toggleClass('display');

    });

});

