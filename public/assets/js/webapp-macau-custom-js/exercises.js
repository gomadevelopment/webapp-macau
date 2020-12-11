$(function() {
    hideExtraLevels();
    hideExtraCategories();
    hideExtraTags();
    hideExtraProfessors();
    hideExtraVisibility();

    // Level
    function hideExtraLevels() {
        $(".show_more_levels").show();
        $(".show_less_levels").hide();
        $("ul.levels")
            .find("li")
            .not(":nth-child(1)")
            .not(":nth-child(2)")
            .not(":nth-child(3)")
            .hide();
    }

    function showExtraLevels() {
        $(".show_more_levels").hide();
        $(".show_less_levels").show();
        $("ul.levels")
            .find("li")
            .show();
    }

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

    // Tags
    function hideExtraTags() {
        $(".show_more_tags").show();
        $(".show_less_tags").hide();
        $("div.filter_tags")
            .find("label")
            .not(":nth-child(2)")
            .not(":nth-child(4)")
            .not(":nth-child(6)")
            .hide();
    }

    function showExtraTags() {
        $(".show_more_tags").hide();
        $(".show_less_tags").show();
        $("div.filter_tags")
            .find("label")
            .show();
    }

    // Professor
    function hideExtraProfessors() {
        $(".show_more_professors").show();
        $(".show_less_professors").hide();
        $("ul.professors")
            .find("li")
            .not(":nth-child(1)")
            .not(":nth-child(2)")
            .not(":nth-child(3)")
            .hide();
    }

    function showExtraProfessors() {
        $(".show_more_professors").hide();
        $(".show_less_professors").show();
        $("ul.professors")
            .find("li")
            .show();
    }

    // Visibility
    function hideExtraVisibility() {
        $(".show_more_visibility").show();
        $(".show_less_visibility").hide();
        $("ul.visibility")
            .find("li")
            .not(":nth-child(1)")
            .not(":nth-child(2)")
            .hide();
    }

    function showExtraVisibility() {
        $(".show_more_visibility").hide();
        $(".show_less_visibility").show();
        $("ul.visibility")
            .find("li")
            .show();
    }

    $(document).on("click", ".show_more_levels", function(e) {
        e.preventDefault();
        showExtraLevels();
    });
    $(document).on("click", ".show_less_levels", function(e) {
        e.preventDefault();
        hideExtraLevels();
    });
    $(document).on("click", ".show_more_categories", function(e) {
        e.preventDefault();
        showExtraCategories();
    });
    $(document).on("click", ".show_less_categories", function(e) {
        e.preventDefault();
        hideExtraCategories();
    });
    $(document).on("click", ".show_more_tags", function(e) {
        e.preventDefault();
        showExtraTags();
    });
    $(document).on("click", ".show_less_tags", function(e) {
        e.preventDefault();
        hideExtraTags();
    });
    $(document).on("click", ".show_more_professors", function(e) {
        e.preventDefault();
        showExtraProfessors();
    });
    $(document).on("click", ".show_less_professors", function(e) {
        e.preventDefault();
        hideExtraProfessors();
    });
    $(document).on("click", ".show_more_visibility", function(e) {
        e.preventDefault();
        showExtraVisibility();
    });
    $(document).on("click", ".show_less_visibility", function(e) {
        e.preventDefault();
        hideExtraVisibility();
    });
});
