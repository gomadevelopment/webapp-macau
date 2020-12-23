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
    var timerStartedBool = false;
    const minutesInput = 90;
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
        e.preventDefault();
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
        $("#pauseButton").show();
        timer = setInterval(tick, 1000);
    }

    function pauseTimer() {
        clearInterval(timer);
        $("#startButton").show();
        $("#pauseButton").hide();
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

    //////////

    // Defines identifiers for accessing HTML elements
    // const minutesInput = document.getElementById("minutesInput"),
    //     startButton = document.getElementById("startButton"),
    //     pauseButton = document.getElementById("pauseButton"),
    //     unpauseButton = document.getElementById("startButton"),
    //     counterDiv = document.getElementById("counterDisplay");

    // // Adds listeners and declares global variables
    // startButton.addEventListener("click", start);
    // pauseButton.addEventListener("click", pauseTimer);
    // unpauseButton.addEventListener("click", runTimer);
    // let totalSeconds; // global variable to count down total seconds
    // let timer; // global variable for setInterval and clearInterval

    // //Disables buttons that are not needed yet
    // // pauseButton.hide();
    // // hide(pauseButton);
    // // hide(unpauseButton);

    // // Defines functions that get the minutes and seconds for display
    // function getMinutes(totalSeconds) {
    //     return Math.floor(totalSeconds / 60); // Gets quotient rounded down
    // }

    // function getSeconds(totalSeconds) {
    //     let seconds = totalSeconds % 60; // Gets remainder after division
    //     return seconds < 10 ? "0" + seconds : seconds; // Inserts "0" if needed
    // }

    // // Defines functions that manipulate the countdown
    // function start(e) {
    //     e.preventDefault();
    //     totalSeconds = minutesInput.value * 60; // Sets initial value of totalSeconds based on user input
    //     counterDiv.innerHTML =
    //         getMinutes(totalSeconds) + ":" + getSeconds(totalSeconds); // Initializes display
    //     hide(minutesInput);
    //     hide(startButton); // Toggles buttons
    //     runTimer();
    // }

    // function runTimer(e) {
    //     e.preventDefault();
    //     // Is the main timer function, calls `tick` every 1000 milliseconds
    //     timer = setInterval(tick, 1000);
    //     hide(unpauseButton);
    //     show(pauseButton); // Toggles buttons
    // }

    // function tick() {
    //     if (totalSeconds > 0) {
    //         totalSeconds--; // Decreases total seconds by one
    //         counterDiv.innerHTML =
    //             getMinutes(totalSeconds) + ":" + getSeconds(totalSeconds); // Updates display
    //     } else {
    //         // The timer has reached zero. Let the user start again.
    //         show(minutesInput);
    //         show(startButton);
    //         hide(pauseButton);
    //         hide(unpauseButton);
    //     }
    // }

    // function pauseTimer(e) {
    //     e.preventDefault();
    //     // Stops calling `tick` and toggles buttons
    //     clearInterval(timer);
    //     hide(pauseButton);
    //     show(unpauseButton);
    // }

    // // Defines functions to hide and re-show HTML elements
    // function hide(element) {
    //     element.setAttribute("hidden", "");
    // }
    // function show(element) {
    //     element.removeAttribute("hidden");
    // }
});
