$(function() {
    /*
     * Exercises List
     */

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

    /*
     * Perform Exercise
     */

    // Exercise Timer
    var totalSeconds;
    var timer;
    var countDown;
    var timerStartedBool = false;
    const minutesInput = $("#minutesInput").val();
    const counterDiv = $("#counterDisplay");

    counterDiv.text(
        getHours(minutesInput * 60) +
            ":" +
            getMinutes(minutesInput * 60) +
            ":" +
            getSeconds(minutesInput * 60)
    );

    $("#startButton").hide();
    $("#pauseButton").hide();

    $(document).on("click", "#startButton", function(e) {
        e.preventDefault();
        if (!timerStartedBool) {
            startTimer();
        } else {
            runTimer();
        }
    });

    $(document).on("click", "#pauseButton", function(e) {
        // e.preventDefault();
        pauseTimer();
    });

    function startTimer() {
        timerStartedBool = true;
        totalSeconds = minutesInput * 60; // Sets initial value of totalSeconds based on user input
        counterDiv.text(
            getHours(totalSeconds) +
                ":" +
                getMinutes(totalSeconds) +
                ":" +
                getSeconds(totalSeconds)
        );
        runTimer();
    }

    function runTimer() {
        $("#startButton").hide();
        if (!$("#startButton").hasClass("no_interruption_time")) {
            $("#pauseButton").show();
        }
        clearInterval(countDown);
        timer = setInterval(tick, 1000);
    }

    function pauseTimer() {
        clearInterval(timer);
        if ($(".nav-link#evaluation-tab").hasClass("finished")) {
            return false;
        }
        if (!$("#startButton").hasClass("no_interruption_time")) {
            $("#startButton").show();
        }
        $("#pauseButton").hide();
        countDown = setInterval(theFunction, 1000);
    }

    function tick() {
        if (totalSeconds > 0) {
            totalSeconds--; // Decreases total seconds by one
            counterDiv.text(
                getHours(totalSeconds) +
                    ":" +
                    getMinutes(totalSeconds) +
                    ":" +
                    getSeconds(totalSeconds)
            );
        } else {
            // The timer has reached zero. Let the user start again.
            $("#startButton").hide();
            $("#pauseButton").hide();
        }
    }

    function getHours(totalSeconds) {
        var hours = Math.floor(
            ((totalSeconds * 1000) % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
        );
        return hours < 10 ? "0" + hours : hours;
    }

    function getMinutes(totalSeconds) {
        var minutes = Math.floor(
            ((totalSeconds * 1000) % (1000 * 60 * 60)) / (1000 * 60)
        );
        return minutes < 10 ? "0" + minutes : minutes;
    }

    function getSeconds(totalSeconds) {
        var seconds = Math.floor(((totalSeconds * 1000) % (1000 * 60)) / 1000);
        return seconds < 10 ? "0" + seconds : seconds;
    }

    // Pause Countdown
    if ($("#pause_countdown").length) {
        var rawAmount = $("#pause_countdown").val();
        var split = rawAmount.split(":");
        var minutes = split[0];
        var seconds = split[1];
        var totalAmount = parseInt(minutes, 10) * 60;
        if (seconds) {
            totalAmount += parseInt(seconds, 10);
        }
    }

    // $("#pause_countdown").val(" ");
    theFunction = function() {
        totalAmount--;

        if (totalAmount == 0) {
            clearInterval(countDown);
            $(".unpause_exercise_modal_button").click();
            $("#pause_countdown").val("00:00");
            $("#startButton").hide();
            $("#pauseButton").hide();
        }
        var minutes = parseInt(totalAmount / 60);
        var seconds = parseInt(totalAmount % 60);

        if (seconds < 10) seconds = "0" + seconds;
        $("label.pause_counter_modal").text(minutes + ":" + seconds);
        $("#pause_countdown").val(minutes + ":" + seconds);
    };

    $(document).on("click", ".unpause_exercise_modal_button", function(e) {
        e.preventDefault();
        $(this)
            .closest(".modal")
            .modal("hide");
        $("#startButton").click();
    });
});
