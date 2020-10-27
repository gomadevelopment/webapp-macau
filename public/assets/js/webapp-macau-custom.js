$(function() {
    $(document).on("click", ".eye-hide, .eye-show", function() {
        console.log($(this).attr("class"));

        if ($(this).attr("class") == "eye-hide") {
            $(this).css("display", "none");
            $(this)
                .next($(".eye-show"))
                .css("display", "block");
            $(this)
                .prev($("input"))
                .attr("type", "text");
        } else {
            $(this).css("display", "none");
            $(this)
                .prev($(".eye-hide"))
                .css("display", "block");
            $(this)
                .prev()
                .prev()
                .attr("type", "password");
        }
    });

    var signup_form_validate = $("#signup form").validate({
        rules: {
            username: {
                required: true,
                minlength: 6
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            username: {
                required: "Insira o seu nome de utilizador.",
                minlength: "Nome com mínimo de 6 caracteres."
            },
            email: {
                required: "Insira o seu e-mail.",
                email: "Insira um e-mail válido."
            },
            password: {
                required: "Insira uma password.",
                minlength: "Password com mínimo de 6 caracteres."
            },
            password_confirmation: {
                required: "Confirme a sua password.",
                equalTo: "As palavras-passe não coincidem."
            }
        }
    });

    var login_form_validate = $("#login form").validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true
            }
        },
        messages: {
            username: {
                required: "Insira o seu nome de utilizador."
            },
            password: {
                required: "Insira a sua password."
            }
        }
    });

    $("#signup form").on("submit", function(event) {
        if (signup_form_validate.errorList.length == 0) {
            $(this).submit();
        }
    });

    $("#login form").on("submit", function(event) {
        if (login_form_validate.errorList.length == 0) {
            $(this).submit();
        }
    });
});
