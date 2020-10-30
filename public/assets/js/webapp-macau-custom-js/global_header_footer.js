$(function() {
    /* HEADER */

    // Scroll to section on nav-bar menu click
    $(".nav-menu a").on("click", function(event) {
        if (!$(this).hasClass("nav-link")) {
            $(".navigation-portrait .nav-menus-wrapper-close-button").trigger(
                "click"
            );
        }

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            event.preventDefault();

            var hash = this.hash;
            var offset_disc =
                hash == "#sobre" ? -20 : $(".header").height() - 2;

            if ($(window).width() < 992) {
                offset_disc = 0;
            }

            $("html, body").animate(
                {
                    scrollTop: $(hash).offset().top - offset_disc
                },
                800
            );
        }
    });

    // $(".user_avatar.dropdown a.messages").on("mouseenter", function(event) {
    //     event.preventDefault();
    //     $(this)
    //         .parent()
    //         .addClass("show");
    //     $(this)
    //         .next()
    //         .css("transform", "translate3d(-5px, 82px, 0px)")
    //         .css("left", "0px")
    //         .css("will-change", "transform")
    //         .addClass("show");
    // });

    // $(".user_avatar.dropdown a.messages").on("mouseleave", function(event) {
    //     event.preventDefault();
    //     $(this)
    //         .parent()
    //         .removeClass("show");
    //     $(this)
    //         .next()
    //         .css("transform", "translate3d(-5px, 82px, 0px)")
    //         .css("left", "0px")
    //         .css("will-change", "transform")
    //         .removeClass("show");
    // });
});
