$(function() {
    /* HEADER */

    // Scroll to section on nav-bar menu click
    $(".nav-menu a").on("click", function(event) {
        $(".navigation-portrait .nav-menus-wrapper-close-button").trigger(
            "click"
        );

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
});
