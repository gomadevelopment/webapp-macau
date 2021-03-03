$(function() {
    if ($("#exame_review").val() == true) {
        $("video").trigger("pause");
    }
    $(document).on("click", "#finish_exercise_button", function(e) {
        // Deactivate finish_exercise_button
        $(this).attr("id", "");

        $("#perform_exercise_form").hide();
        $(".preloader.ajax").show();
        $("html, body").animate({ scrollTop: "0px" }, 300);

        var exercise_id = $("#exercise_id_hidden").val();
        var exame_id = $("#exame_id").val();

        var formData = new FormData($("form#perform_exercise_form")[0]);
        formData.append("exame_id", exame_id);

        // Inquiries
        var inquiries = new Array();
        $(".rb").each(function(index, element) {
            var inquiry_id = $(element).attr("data-id");
            var data_value = $(element)
                .find(".rb-tab-active")
                .attr("data-value");
            inquiries[inquiry_id] = data_value;
        });

        for (var key in inquiries) {
            formData.append("inquiries[" + key + "]", inquiries[key]);
        }

        $.ajax({
            url: "/exercicios/realizar/" + exercise_id,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $("#perform_exercise_form").show();
                $(".preloader.ajax").hide();
                if (response && response.status == "success") {
                    if (response.teacher_correction) {
                        $("#score_label").text("Nota Provisória: ");
                        $("#score_percentage")
                            .addClass("exercise_awaiting")
                            .text(response.score + "%");
                    } else {
                        $("#score_label").text("Nota: ");

                        if (response.score < 33.3) {
                            $("#score_percentage")
                                .addClass("low_score")
                                .text(response.score + "%");
                        } else if (
                            response.score >= 33.3 &&
                            response.score < 66.6
                        ) {
                            $("#score_percentage")
                                .addClass("med_score")
                                .text(response.score + "%");
                        } else {
                            $("#score_percentage")
                                .addClass("high_score")
                                .text(response.score + "%");
                        }
                    }
                    $("#conclusion_date_label").text(response.conclusion_time);
                } else if (response.status == "error") {
                    $("#score_percentage").remove();
                    $("#score_label").text(
                        "Ocorreu um erro ao submeter o seu exame. Por favor, contacte um professor."
                    );
                    $("#conclusion_date_label").text(response.conclusion_time);
                }

                $("#perform_exercise_tabs .nav-link").addClass("disabled");
                $(".nav-link#evaluation-tab")
                    .removeClass("disabled")
                    .addClass("finished");
                $("#evaluation-tab").show();
                $("#pauseButton").attr("data-toggle", "");
                $("#pauseButton").attr("data-target", "");
                $("#pauseButton").click();
                $("#pauseButton").hide();
                $("#startButton").hide();
                $("#accordion").hide();

                $("#evaluation-tab").click();

                // var offset_disc = $(".header").height() + 10;

                // if ($(window).width() < 992) {
                //     offset_disc = 0;
                // }

                // $("html, body").animate(
                //     {
                //         scrollTop: $('#evaluation').offset().top - offset_disc
                //     },
                //     800
                // );
            }
        });
    });

    // /exercicios/realizar/update_pause_timer/{exame_id}

    $(document).on("click", "#pauseButton, #startButton", function() {
        if ($(this).attr("data-target") == "") {
            return false;
        }
        var exame_id = $("#exame_id").val();
        var to_update = "";
        var dt = new Date();
        var date =
            dt.getUTCFullYear() +
            "-" +
            (dt.getUTCMonth() + 1 < 10
                ? "0" + (dt.getUTCMonth() + 1)
                : dt.getUTCMonth() + 1) +
            "-" +
            (dt.getUTCDate() < 10 ? "0" + dt.getUTCDate() : dt.getUTCDate()) +
            " ";
        var time =
            dt.getHours() +
            ":" +
            dt.getMinutes() +
            ":" +
            (dt.getSeconds() < 10 ? "0" + dt.getSeconds() : dt.getSeconds());
        var to_update_timestamp = date + time;
        if ($(this).attr("id") == "pauseButton") {
            to_update = "pause_start";
        } else if ($(this).attr("id") == "startButton") {
            to_update = "pause_end";
        }
        $.ajax({
            url: "/exercicios/realizar/update_pause_timer/" + exame_id,
            type: "GET",
            data: {
                to_update: to_update,
                to_update_timestamp: to_update_timestamp
            },
            success: function(response) {
                if (response && response.status == "success") {
                } else if (response.status == "error") {
                }
            }
        });
    });

    // $('.drag_and_drop_item').draggable();

    if ($("#exame_review").val() == false) {
        $(".drag_and_drop_item").draggable({
            revert: "invalid",
            scope: "items",
            // snap: ".drop",
            scroll: "true",
            scrollSensitivity: 40,
            scrollSpeed: 30,
            helper: "clone",
            start: function(evt, ui) {
                $(this).hide();
                if (
                    !$("button.hide_video").is(":hidden") &&
                    !$("button.hide_video").hasClass("drag_hidden")
                ) {
                    $("button.hide_video")
                        .hide()
                        .addClass("drag_hidden");
                    $("button.show_video").show();
                    $(".videoWrapper video").trigger("pause");
                    $(".videoWrapper")
                        .hide()
                        .removeClass("stuck");
                }
            },
            stop: function(evt, ui) {
                $(this).show();
            }
        });
        $(".drop").droppable({
            accept: ".drag_and_drop_item",
            scope: "items",
            drop: function(evt, ui) {
                var item_dropped = ui.draggable;
                var droppedOn = $(this);

                item_dropped.parent().append(droppedOn.children());

                droppedOn.append(item_dropped);

                item_dropped.css({
                    left: 0,
                    top: 0
                });

                setTimeout(function() {
                    // Correspondence
                    if (item_dropped.hasClass("correspondence_items")) {
                        $("input.correspondence_d_and_d").each(function(
                            index,
                            element
                        ) {
                            // Images and Audios
                            if ($(element).next(".drag_and_drop_hole").length) {
                                // console.log($(element).find('input').val(), $(element.attr('class')));
                                if (
                                    $.trim(
                                        $(element)
                                            .next(".drag_and_drop_hole")
                                            .html()
                                    ) == ""
                                ) {
                                    $(element).val(null);
                                } else {
                                    $(element).val(
                                        $(element)
                                            .next(".drag_and_drop_hole")
                                            .find("input")
                                            .val()
                                    );
                                }
                                // console.log($(element).val());
                            }
                            // Categories
                            else {
                                $(element)
                                    .next("div")
                                    .each(function(index2, element2) {
                                        if (
                                            $.trim(
                                                $(element2)
                                                    .find(".drag_and_drop_hole")
                                                    .html()
                                            ) == ""
                                        ) {
                                            $(element).val(null);
                                        } else {
                                            $(element).val(
                                                $(element2)
                                                    .find(".drag_and_drop_hole")
                                                    .find("input")
                                                    .val()
                                            );
                                        }
                                    });
                            }
                        });
                    }
                    // Fill Options - Shuffle
                    else if (
                        item_dropped.hasClass("fill_options_shuffle_items")
                    ) {
                        $("input.fill_options_d_and_d").each(function(
                            index,
                            element
                        ) {
                            if (
                                $.trim(
                                    $(element)
                                        .next(".drag_and_drop_hole")
                                        .html()
                                ) == ""
                            ) {
                                $(element).val(null);
                            } else {
                                $(element).val(
                                    $(element)
                                        .next(".drag_and_drop_hole")
                                        .find("input")
                                        .val()
                                );
                            }
                        });
                    }
                    // True or False
                    else if (item_dropped.hasClass("true_or_false_items")) {
                        $("input.true_or_false_d_and_d").each(function(
                            index,
                            element
                        ) {
                            if (
                                $.trim(
                                    $(element)
                                        .next(".drag_and_drop_hole")
                                        .html()
                                ) == ""
                            ) {
                                $(element).val(null);
                            } else {
                                $(element).val(
                                    $(element)
                                        .next(".drag_and_drop_hole")
                                        .find("input")
                                        .val()
                                );
                            }
                        });
                    }
                    // Vowels
                    else if (item_dropped.hasClass("vowels_items")) {
                        $("input.vowels_d_and_d").each(function(
                            index,
                            element
                        ) {
                            $(element)
                                .next("div")
                                .each(function(index2, element2) {
                                    if (
                                        $.trim(
                                            $(element2)
                                                .find(".drag_and_drop_hole")
                                                .html()
                                        ) == ""
                                    ) {
                                        $(element).val(null);
                                    } else {
                                        $(element).val(
                                            $(element2)
                                                .find(".drag_and_drop_hole")
                                                .find("input")
                                                .val()
                                        );
                                    }
                                });
                        });
                    }
                }, 100);
            }
        });

        $(
            '[id^="assortment_sentences_table_question_item_"], [id^="assortment_images_table_question_"]'
        ).sortable({
            placeholder: "ui-state-highlight",
            scroll: true,
            scrollSensitivity: 40,
            scrollSpeed: 30
        });
        $(
            '[id^="assortment_sentences_table_question_item_"], [id^="assortment_images_table_question_"]'
        ).disableSelection();

        $('[id^="assortment_words_table_question_item_"]').sortable({
            placeholder: "ui-state-highlight",
            scroll: true,
            scrollSensitivity: 40,
            scrollSpeed: 30,
            // helper: "clone",
            update: function(evt, ui) {
                // console.log("111");
                var word_preview = "";
                $(this)
                    .find("li span")
                    .each(function(index, element) {
                        word_preview += $(element).text() + " ";
                    });
                $(this)
                    .prevAll(".word_preview")
                    .text(word_preview);
            }
        });
        $('[id^="assortment_words_table_question_item_"]').disableSelection();
    } else {
        $(".drag_and_drop_item").css("cursor", "default");
        $(
            '[id^="assortment_sentences_table_question_item_"], [id^="assortment_images_table_question_"], [id^="assortment_words_table_question_item_"]'
        )
            .find("li")
            .css("cursor", "default");
        $(
            '[id^="exame_review_assortment_sentences_table_question_item_"], [id^="exame_review_assortment_images_table_question_"], [id^="exame_review_assortment_words_table_question_item_"]'
        )
            .find("li")
            .css("cursor", "default");
    }

    // Start Exercise
    $(document).on(
        "click",
        ".start_exercise, .perform_exercise_nav_button",
        function(e) {
            if ($(this).hasClass("start_exercise")) {
                $(this).hide();
                // $('.nav-link.disabled').removeClass('disabled');
                $("#evaluation-tab").hide();
                $("#startButton").click();
            } else {
                $($(this).attr("href") + "-tab").click();
            }

            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "" && !$(this).hasClass("start_exercise")) {
                e.preventDefault();

                var hash =
                    this.hash !== "#quiz-div" ? this.hash + "-tab" : this.hash;

                var offset_disc = $(".header").height() + 10;

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
        }
    );

    $(".start_exercise").click();
    $(".start_exercise").hide();

    // Change icon image on tab change
    changeIconImage();
    function changeIconImage() {
        $("#perform_exercise_tabs a.nav-link").each(function(index, element) {
            if ($(element).hasClass("active")) {
                $(element)
                    .find(".white_icon")
                    .show();
                $(element)
                    .find(".black_icon")
                    .hide();
            } else {
                $(element)
                    .find(".white_icon")
                    .hide();
                $(element)
                    .find(".black_icon")
                    .show();
            }
        });
    }

    $(document).on("click", "#perform_exercise_tabs a.nav-link", function() {
        changeIconImage();
    });

    // Change right side info_accordion icon
    changeAccordionInfoIcon($(".info_accordion a"));
    function changeAccordionInfoIcon(selector) {
        if ($(selector).hasClass("collapsed")) {
            $(selector)
                .find(".show_info_button")
                .show();
            $(selector)
                .find(".hide_info_button")
                .hide();
        } else {
            $(selector)
                .find(".show_info_button")
                .hide();
            $(selector)
                .find(".hide_info_button")
                .show();
        }
    }

    $(document).on("click", ".info_accordion a", function() {
        changeAccordionInfoIcon($(this));
    });

    $("#exercise_template").select2({
        placeholder: "Escolher exercício"
    });

    $("#categories").select2({
        placeholder: "Escolher tema"
    });

    $("#levels").select2({
        placeholder: "Escolher Nível"
    });

    $("#tags").select2({
        placeholder: "Pesquisar"
    });

    $("#fill_time").select2({
        placeholder: "Sel. Tempo"
    });

    $("#interruption_time").select2({
        placeholder: "Sel. Tempo"
    });

    $("#verbs_select_1").select2();

    $("#verbs_select_2").select2();

    $('[id^="word_select_question_item_"]').select2({
        placeholder: "Escolher..."
    });
    $('[id^="exame_review_word_select_question_item_"]').select2({
        placeholder: "Escolher..."
    });

    $('[id^="true_or_false_select_question_item_"]').select2({
        placeholder: "Escolher..."
    });
    $('[id^="exame_review_true_or_false_select_question_item_"]').select2({
        placeholder: "Escolher..."
    });

    $('[id^="m_c_questions_select_question_item_"]').select2({
        placeholder: "Escolher..."
    });
    $('[id^="exame_review_m_c_questions_select_question_item_"]').select2({
        placeholder: "Escolher..."
    });

    $('[id^="m_c_intruder_select_question_item_"]').select2({
        placeholder: "Escolher..."
    });
    $('[id^="exame_review_m_c_intruder_select_question_item_"]').select2({
        placeholder: "Escolher..."
    });

    $(".rb-tab").click(function() {
        if ($("#exame_review").val() == false) {
            $(this)
                .parent()
                .find(".rb-tab")
                .removeClass("rb-tab-active");
            $(this).addClass("rb-tab-active");
        }
    });

    $(".under_tabs_video_card").hide();
    $(".videoWrapper")
        .removeClass("stuck")
        .hide();
    $(".show_video").hide();
    $("button.hide_video").hide();

    $(document).on("click", "#perform_exercise_tabs .nav-link", function() {
        if (
            $(this).attr("id") == "intro-tab" ||
            $(this).attr("id") == "pre-listening-tab" ||
            $(this).attr("id") == "evaluation-tab"
        ) {
            $(".under_tabs_video_card").hide();
            // Hide bottom video
            if ($("button.show_video").is(":hidden")) {
                $("button.hide_video").click();
                if (
                    !$(".videoWrapper").hasClass("stuck") &&
                    $(".videoWrapper").hasClass("was_opened")
                ) {
                    $(".videoWrapper").addClass("stuck");
                }
            }
            $(".videoWrapper").hide();
            $(".show_video").hide();
            $(".hide_video").hide();
        } else {
            $(".under_tabs_video_card").hide();
            // Hide bottom video
            if ($("button.show_video").is(":hidden")) {
                $("button.hide_video").click();
                if (
                    !$(".videoWrapper").hasClass("stuck") &&
                    $(".videoWrapper").hasClass("was_opened")
                ) {
                    $(".videoWrapper").addClass("stuck");
                }
            }
            $(".videoWrapper").hide();
            $(".show_video").hide();
            $(".hide_video").hide();
            if (
                $(this).attr("id") == "listening-tab" &&
                $("#listening_questions_count").val() > 0
            ) {
                $(".under_tabs_video_card").show();
                $(".videoWrapper").show();
                $(".show_video").show();
            } else if (
                $(this).attr("id") == "listening-shop-tab" &&
                $("#listening_shop_questions_count").val() > 0
            ) {
                $(".under_tabs_video_card").show();
                $(".videoWrapper").show();
                $(".show_video").show();
            } else if (
                $(this).attr("id") == "after-listening-tab" &&
                $("#after_listening_questions_count").val() > 0
            ) {
                $(".under_tabs_video_card").show();
                $(".videoWrapper").show();
                $(".show_video").show();
            }
        }

        if (
            $("button.show_video").is(":visible") &&
            !$("button.hide_video").is(":visible")
        ) {
            $(".videoWrapper")
                .removeClass("stuck")
                .hide();
        }

        $("#perform_exercise_tabs_content>.tab-pane").each(function(
            index,
            element
        ) {
            $(element).removeClass("show");
            $(element).removeClass("active");
        });

        var this_id = $(this).attr("id");

        $("#perform_exercise_tabs_content>.tab-pane").each(function(
            index,
            element
        ) {
            if ($(element).attr("aria-labelledby") == this_id) {
                $(element).addClass("fade");
                $(element).addClass("show");
                $(element).addClass("active");

                if ($(element).attr("id") == "pre-listening") {
                    $("#perform_pre_listening_tabs .nav-link:first").trigger(
                        "click"
                    );
                }

                if ($(element).attr("id") == "listening") {
                    $("#perform_listening_tabs .nav-link:first").trigger(
                        "click"
                    );
                }

                if ($(element).attr("id") == "listening-shop") {
                    $("#perform_listening_shop_tabs .nav-link:first").trigger(
                        "click"
                    );
                }
            }
        });
    });

    // Button show/hide video
    $(".videoWrapper video").trigger("pause");

    $(document).on("click", "button.show_video, button.hide_video", function() {
        if ($(this).hasClass("show_video")) {
            $(this).hide();
            $("button.hide_video").show();
            $(".videoWrapper")
                .show()
                .addClass("stuck");
            if (!$(".videoWrapper").hasClass("was_opened")) {
                $(".videoWrapper").addClass("was_opened");
            }
        } else {
            $(this).hide();
            $("button.show_video").show();
            $(".videoWrapper video").trigger("pause");
            $(".videoWrapper")
                .hide()
                .removeClass("stuck");
        }

        if (
            $("button.show_video").is(":visible") &&
            !$("button.hide_video").is(":visible")
        ) {
            $(".videoWrapper")
                .removeClass("stuck")
                .hide();
        }
    });

    // $('button.hide_video').click();

    $(".videoWrapper video").on("play", function() {
        $(".under_tabs_video_card video").trigger("pause");
    });

    $(".under_tabs_video_card video").on("play", function() {
        $(".videoWrapper video").trigger("pause");
    });

    /*Floating js Start*/
    var windows = jQuery(window);
    var iframeWrap = jQuery(this).parent();
    var iframe = jQuery(this);
    var iframeHeight = iframe.outerHeight();
    var iframeElement = iframe.get(0);

    iframeWrap.height(iframeHeight);
    iframe.addClass("stuck");

    windows.on("scroll", function() {
        // console.log($(this).scrollTop());
        if ($(this).scrollTop() >= 500) {
            if (
                !$(".videoWrapper").hasClass("was_opened") &&
                !$("#pre-listening-tab").hasClass("active")
            ) {
                $("button.show_video").click();

                if (
                    $("button.show_video").is(":visible") &&
                    !$("button.hide_video").is(":visible")
                ) {
                    $(".videoWrapper")
                        .removeClass("stuck")
                        .hide();
                }
            }
        } else {
            if (
                $("button.hide_video").is(":visible") &&
                !$("button.show_video").is(":visible")
            ) {
                $("button.hide_video").click();
            }
        }
        iframeWrap.height(iframeHeight);
        iframe.addClass("stuck");
    });
    /*Floating js End*/

    // QUIZ Language Switch
    $(".en_label").attr("style", "display: none !important;");
    $(document).on("change", ".quiz_lang_switch input", function() {
        // console.log($(this).is(":checked"));
        // See in English
        if ($(this).is(":checked")) {
            $(".en_label:not(.button_label)").attr("style", "display: block;");
            $(".en_label.button_label").attr("style", "display: inline-block;");
            $(".pt_label").attr("style", "display: none !important;");
        }
        // See in Portuguese
        else {
            $(".en_label").attr("style", "display: none !important;");
            $(".pt_label:not(.button_label)").attr("style", "display: block;");
            $(".pt_label.button_label").attr("style", "display: inline-block;");
        }
    });
});
