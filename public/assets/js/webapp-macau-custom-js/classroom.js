$(function() {
    hideExtraStudentsColleagues();

    // Stundets + Colleagues
    function hideExtraStudentsColleagues() {
        $(".students_colleagues_see_all").show();
        $(".students_colleagues_see_less").hide();
        $(".students_colleagues")
            .find(".form-group.flex-wrap")
            .not(":nth-child(1)")
            .not(":nth-child(2)")
            .not(":nth-child(3)")
            .attr("style", "display: none !important;");
    }

    function showExtraStudentsColleagues() {
        $(".students_colleagues_see_all").hide();
        $(".students_colleagues_see_less").show();
        $(".students_colleagues .form-group.flex-wrap").attr(
            "style",
            "display: flex !important;"
        );
    }

    $(document).on("click", ".students_colleagues_see_all", function(e) {
        e.preventDefault();
        showExtraStudentsColleagues();
    });
    $(document).on("click", ".students_colleagues_see_less", function(e) {
        e.preventDefault();
        hideExtraStudentsColleagues();
    });
});
