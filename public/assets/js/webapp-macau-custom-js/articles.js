$(function() {
    hideExtraCategories();
    hideExtraMostrar();
    hideExtraTags();

    // Categories
    function hideExtraCategories() {
        $(".show_more_categories").show();
        $(".show_less_categories").hide();
        $("ul.categories")
            .find("li")
            .not(":nth-child(1)")
            .not(":nth-child(2)")
            .not(":nth-child(3)")
            .hide();
    }

    function showExtraCategories() {
        $(".show_more_categories").hide();
        $(".show_less_categories").show();
        $("ul.categories")
            .find("li")
            .show();
    }

    // Show (Mostrar)
    function hideExtraMostrar() {
        $(".show_more_mostrar").show();
        $(".show_less_mostrar").hide();
        $("ul.mostrar")
            .find("li")
            .not(":nth-child(1)")
            .not(":nth-child(2)")
            .not(":nth-child(3)")
            .hide();
    }

    function showExtraMostrar() {
        $(".show_more_mostrar").hide();
        $(".show_less_mostrar").show();
        $("ul.mostrar")
            .find("li")
            .show();
    }

    // Tags
    function hideExtraTags() {
        $(".show_more_tags").show();
        $(".show_less_tags").hide();
        $("div.filter_tags")
            .find("a")
            .not(":nth-child(1)")
            .not(":nth-child(2)")
            .not(":nth-child(3)")
            .hide();
    }

    function showExtraTags() {
        $(".show_more_tags").hide();
        $(".show_less_tags").show();
        $("div.filter_tags")
            .find("a")
            .show();
    }

    $(document).on("click", ".show_more_categories", function(e) {
        e.preventDefault();
        showExtraCategories();
    });
    $(document).on("click", ".show_less_categories", function(e) {
        e.preventDefault();
        hideExtraCategories();
    });
    $(document).on("click", ".show_more_mostrar", function(e) {
        e.preventDefault();
        showExtraMostrar();
    });
    $(document).on("click", ".show_less_mostrar", function(e) {
        e.preventDefault();
        hideExtraMostrar();
    });
    $(document).on("click", ".show_more_tags", function(e) {
        e.preventDefault();
        showExtraTags();
    });
    $(document).on("click", ".show_less_tags", function(e) {
        e.preventDefault();
        hideExtraTags();
    });
});
