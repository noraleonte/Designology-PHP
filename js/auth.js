$(document).ready(function () {

    $(window).ready(function (e) {
        $("#myModal").remove();
    });
    // password validation
    $("#psw").focus(function () {
        $(".errors").hide();
        $("#psw").siblings(".message").show(500);
    });
    $("#psw").blur(function () {

        $("#psw").siblings(".message").hide(500);
    });

    $("#psw").keyup(function () {
        let lwrletters = /[a-z]/g;
        let capitals = /[A-Z]/g;
        let numbers = /[0-9]/g;
        let val = $("#psw").val();
        //lowercase letters
        if (lwrletters.test(val)) {
            $("#letter").removeClass("invalid");
            $("#letter").addClass("valid");
        } else {
            $("#letter").removeClass("valid");
            $("#letter").addClass("invalid");
        }
        //capitals
        if (capitals.test(val)) {
            $("#capital").removeClass("invalid");
            $("#capital").addClass("valid");

        } else {
            $("#capital").removeClass("valid");
            $("#capital").addClass("invalid");

        }

        //numbers
        if (numbers.test(val)) {
            $("#number").removeClass("invalid");
            $("#number").addClass("valid");
        } else {
            $("#number").removeClass("valid");
            $("#number").addClass("invalid");
        }

        //length
        if (val.length >= 8) {
            $("#length").removeClass("invalid");
            $("#length").addClass("valid");
        } else {
            $("#length").removeClass("valid");
            $("#length").addClass("invalid");
        }
    });

    $("#repeat").focus(function () {
        $(".errors").hide();
        $("#repeat").siblings(".message").show(500);
    });
    $("#repeat").blur(function () {

        $("#repeat").siblings(".message").hide(500);
    });

    $("#repeat").keyup(function () {
        let pval = $("#psw").val();
        let rval = $("#repeat").val();
        if (rval == pval) {
            $("#confirm").hide();
            $("#confirm2").show();
        } else {
            $("#confirm").show();
            $("#confirm2").hide();
        }
    });

    $("#email").focus(function () {
        $(".errors").hide();

    });


    $("#signup").click(function (event) {
        // event.preventDefault();

        const reg_email = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        const reg_psw = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/;
        var valid = 1;
        if ($("#psw").val()) {
            var psw = $("#psw").val();
            if (reg_psw.test(psw)) {
            } else {
                valid = 0;
                $("#psw").after("<p class=\"errors\">Trebuie să introduci o parolă validă!</p>");
            }
        } else {
            valid = 0;
            $("#psw").after("<p class=\"errors\">Trebuie să introduci o parolă!</p>");
        }
        if ($("#repeat").val()) {
            var repeat = $("#repeat").val();
            if (repeat != psw) {
                valid = 0;
                $("#repeat").after("<p class=\"errors\">Parolele trebuie să coincidă!</p>");
            }
        } else {
            valid = 0;
            $("#repeat").after("<p class=\"errors\">Trebuie să confirmi parola!</p>");
        }
        if ($("#email").val()) {
            var email = $("#email").val();
            if (reg_email.test(email)) {
                $.ajax({
                    url: './utilities/checkEmail.php',
                    type: 'POST',
                    data: {
                        email: email,
                    },
                    success: function (data) {
                        if (data == 1) {
                            valid = 0;
                            $("#email").after("<p class=\"errors\">Există deja un cont cu acest email!</p>");
                        } else {
                            if (valid == 1) {
                                modal = "<div id=\"myModal\" class=\"modal\"> <div class=\"modal-content\">  <h2 class=\"left_text\">Sunt corecte aceste date?</h2><p class=\"userData\">" + email + "</p><div class=\"flex\" style=\"justify-content: space-between; align-items:flex-end\"><button id=\"nope\" class=\"red\">Nu, nu sunt</button><button id=\"go\">Da, sunt corecte</button></div></div ></div > "
                                $("body").append(modal);
                                $(document).on("click", "#nope", function () {
                                    $("#myModal").remove();
                                });
                                $(document).on("click", "#go", function () {
                                    $.ajax({
                                        url: './utilities/newUser.php',
                                        type: 'POST',
                                        data: {
                                            email: email,
                                            psw: psw
                                        },
                                        success: function (data) {
                                            user = data;
                                            // console.log(user);
                                            $.ajax({
                                                url: './utilities/generateCode.php',
                                                type: 'GET',
                                                success: function (code) {
                                                    $.ajax({
                                                        url: './utilities/setCode.php',
                                                        type: 'POST',
                                                        data: {
                                                            code: code,
                                                            user: user
                                                        },
                                                        success: function () {
                                                            $.ajax({
                                                                url: './utilities/PHPmailer/sendEmail.php',
                                                                type: 'POST',
                                                                data: {
                                                                    code: code,
                                                                    email: email
                                                                },
                                                                success: function () {
                                                                    $(location).attr("href", "./activate.php");
                                                                }
                                                            });
                                                        }
                                                    });

                                                }
                                            });
                                        }
                                    });
                                });
                            }
                        }
                    }
                });
            } else {
                $("#email").after("<p class=\"errors\">Trebuie să introduci un email valid!</p>");
            }
        } else {
            $("#email").after("<p class=\"errors\">Trebuie să introduci un email!</p>");
        }

    });
});