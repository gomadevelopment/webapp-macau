$(function() {
    // Show or Hide password on login/signup modal
    $(document).on("click", ".eye-hide, .eye-show", function() {
        if ($(this).attr("class") == "eye-hide") {
            $(this).css("display", "none");
            $(this)
                .next($(".eye-show"))
                .css("display", "block");
            $(this)
                .prevAll("input")
                .attr("type", "text");
        } else {
            $(this).css("display", "none");
            $(this)
                .prev($(".eye-hide"))
                .css("display", "block");
            $(this)
                .prevAll("input")
                .attr("type", "password");
        }
    });

    var homepage_lang = $("#homepage_lang").val();

    // Signup and Login form input validations and form submit
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
                required:
                    homepage_lang == "pt_lang"
                        ? "Insira o seu nome de utilizador."
                        : "Insert your username.",
                minlength:
                    homepage_lang == "pt_lang"
                        ? "Nome com mínimo de 6 caracteres."
                        : "Username has a minimum of 6 characters required."
            },
            email: {
                required:
                    homepage_lang == "pt_lang"
                        ? "Insira o seu e-mail."
                        : "Insert your e-mail.",
                email:
                    homepage_lang == "pt_lang"
                        ? "Insira um e-mail válido."
                        : "Insert a valid e-mail"
            },
            password: {
                required:
                    homepage_lang == "pt_lang"
                        ? "Insira uma password."
                        : "Insert a password.",
                minlength:
                    homepage_lang == "pt_lang"
                        ? "Password com mínimo de 6 caracteres."
                        : "Password has a minimum of 6 characters required."
            },
            password_confirmation: {
                required:
                    homepage_lang == "pt_lang"
                        ? "Confirme a sua password."
                        : "Confirm your password.",
                equalTo:
                    homepage_lang == "pt_lang"
                        ? "As palavras-passe não coincidem."
                        : "The passwords don't match."
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
                required:
                    homepage_lang == "pt_lang"
                        ? "Insira o seu nome de utilizador."
                        : "Insert your username."
            },
            password: {
                required:
                    homepage_lang == "pt_lang"
                        ? "Insira a sua password."
                        : "Insert your password."
            }
        }
    });

    var recover_password_form_validate = $("#recover_password form").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: {
                required:
                    homepage_lang == "pt_lang"
                        ? "Insira o seu e-mail de registo."
                        : "Insert your register e-mail.",
                email:
                    homepage_lang == "pt_lang"
                        ? "Insira um e-mail válido."
                        : "Insert a valid e-mail."
            }
        }
    });

    var new_password_form_validate = $("#new_password form").validate({
        rules: {
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
            password: {
                required:
                    homepage_lang == "pt_lang"
                        ? "Insira uma password."
                        : "Insert a password.",
                minlength:
                    homepage_lang == "pt_lang"
                        ? "Password com mínimo de 6 caracteres."
                        : "Password has a minimum of 6 characters required."
            },
            password_confirmation: {
                required:
                    homepage_lang == "pt_lang"
                        ? "Confirme a sua password."
                        : "Confirm your password.",
                equalTo:
                    homepage_lang == "pt_lang"
                        ? "As palavras-passe não coincidem."
                        : "The passwords don't match."
            }
        }
    });

    ////
    $("#signup input").keypress(function(event) {
        if (event.keyCode === 13) {
            $("#submit_signup_form").click();
        }
    });
    $("#submit_signup_form").on("click", function(event) {
        if (signup_form_validate.errorList.length == 0) {
            $("#signup form").submit();
        }
    });

    ////
    $("#login input").keypress(function(event) {
        if (event.keyCode === 13) {
            $("#submit_login_form").click();
        }
    });
    $("#submit_login_form").on("click", function(event) {
        if (login_form_validate.errorList.length == 0) {
            $("#login form").submit();
        }
    });

    ////
    $("#recover_password input").keypress(function(event) {
        if (event.keyCode === 13) {
            $("#submit_recover_password_form").click();
        }
    });
    $("#submit_recover_password_form").on("click", function(event) {
        if (recover_password_form_validate.errorList.length == 0) {
            $("#recover_password form").submit();
        }
    });

    ////
    $("#new_password input").keypress(function(event) {
        if (event.keyCode === 13) {
            $("#submit_new_password_form").click();
        }
    });
    $("#submit_new_password_form").on("click", function(event) {
        if (new_password_form_validate.errorList.length == 0) {
            $("#new_password form").submit();
        }
    });
});
