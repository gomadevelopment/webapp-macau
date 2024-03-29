$(function () {
    // Success + alert flash info fade
    setTimeout(fade_out, 10000);

    function fade_out() {
        $(".global-alert").fadeOut();
    }

    /* HEADER */

    // Scroll to section on nav-bar menu click
    $(".nav-menu a.homepage-links").on("click", function (event) {

        var requestPath = $(this).attr('data-request-path');

        if (requestPath !== '/') {
            event.preventDefault();
            location.href = '/' + this.hash;
        }

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

            $("html, body").animate({
                    scrollTop: $(hash).offset().top - offset_disc
                },
                800
            );
        }
    });

    // Global Heart like
    $(document).on("click", ".heart_icon, .heart_filled_icon", function () {
        var article_id = $(this).attr("data-article-id");
        if (article_id) {
            return false;
        }
        if ($(this).attr("class") == "heart_icon") {
            $(this).hide();
            $(this)
                .next()
                .show();
        } else {
            $(this).hide();
            $(this)
                .prev()
                .show();
        }
    });
});
