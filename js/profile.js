$(document).ready(function () {
    //progress rings
    function setProgress(percent, circle, circumference) {
        const offset = circumference - percent * circumference;
        circle.css("stroke-dashoffset", offset);

    }
    //load progress rings
    $(window).ready(function (e) {
        $("circle").each(function () {
            var circle = $(this);
            var radius = circle.attr("r");
            var circumference = radius * 2 * Math.PI;
            circle.css("stroke-dashoffset", `${circumference}`);
            console.log(circle.css("stroke-dashoffset"));
            circle.css("stroke-dasharray", `${circumference} ${circumference}`);
            percent = circle.closest("svg").siblings(".ringtext").attr("id");
            setProgress(percent, circle, circumference);



        });
    });
    //hover cover image
    $(".cover_image").hover(function () {
        $(".cover_image").children(".image_hover").toggle();
    });
    //choose cover images modal
    $(".image_hover").click(function () {
        $(window).scrollTop(0);
        $("#chooseCover").show();
        $("body").css("overflow", "hidden");
    });
    //hover profile image
    $(".profile_container").hover(function () {
        $(".profile_hover").toggle();
    });
    //choose profile image modal
    $(".profile_hover").click(function () {
        $(window).scrollTop(0);
        $("#chooseProfile").show();
        $("body").css("overflow", "hidden");
    });

    //changing name
    $("#refresh").click(function () {
        $.ajax({
            url: "./utilities/updateName.php",
            method: "GET",
            success: function (data) {
                $("#updateName").text(data);
                $(".profile_name").children("h2").text(data);
            }
        })
    });

    //change cover image

    $(".choose_cimage").children("div").click(function (event) {

        if ($(event.target).is(".cover1")) {
            var cl = "cover1";
            $(".cover_image").addClass(cl);
            $(".cover_image").removeClass("cover2");
            $(".cover_image").removeClass("cover3");
            $(".cover_image").removeClass("cover4");
            $(".cover_image").removeClass("cover5");
            $(".cover_image").removeClass("cover6");
        } else if ($(event.target).is(".cover2")) {
            var cl = "cover2";
            $(".cover_image").addClass(cl);
            $(".cover_image").removeClass("cover1");
            $(".cover_image").removeClass("cover3");
            $(".cover_image").removeClass("cover4");
            $(".cover_image").removeClass("cover5");
            $(".cover_image").removeClass("cover6");
        } else if ($(event.target).is(".cover3")) {
            var cl = "cover3";
            $(".cover_image").addClass(cl);
            $(".cover_image").removeClass("cover2");
            $(".cover_image").removeClass("cover1");
            $(".cover_image").removeClass("cover4");
            $(".cover_image").removeClass("cover5");
            $(".cover_image").removeClass("cover6");
        } else if ($(event.target).is(".cover4")) {
            var cl = "cover4";
            $(".cover_image").addClass(cl);
            $(".cover_image").removeClass("cover2");
            $(".cover_image").removeClass("cover3");
            $(".cover_image").removeClass("cover1");
            $(".cover_image").removeClass("cover5");
            $(".cover_image").removeClass("cover6");
        } else if ($(event.target).is(".cover5")) {
            var cl = "cover5";
            $(".cover_image").addClass(cl);
            $(".cover_image").removeClass("cover2");
            $(".cover_image").removeClass("cover3");
            $(".cover_image").removeClass("cover4");
            $(".cover_image").removeClass("cover1");
            $(".cover_image").removeClass("cover6");
        } else if ($(event.target).is(".cover6")) {
            var cl = "cover6";
            $(".cover_image").addClass(cl);
            $(".cover_image").removeClass("cover2");
            $(".cover_image").removeClass("cover3");
            $(".cover_image").removeClass("cover4");
            $(".cover_image").removeClass("cover5");
            $(".cover_image").removeClass("cover1");
        }
        $.ajax({
            url: './utilities/insertUserImages.php',
            type: 'POST',
            data: {
                cl: cl
            },
            success: function (data) {
                $("#chooseCover").hide();
                $("body").css("overflow", "scroll");

            }
        });
    });
    //chosing profile image

    $(".choose_pimage").children("div").click(function (event) {
        $(".profile_container").children("img").attr("src", $(event.target).attr('src'));
        var profile = $(event.target).attr('src');
        $.ajax({
            url: './utilities/insertUserImages.php',
            type: 'POST',
            data: {
                profile: profile,
            },
            success: function (data) {
                $("#chooseProfile").hide();
                $("body").css("overflow", "scroll");

            }
        });
    });
    //change email
    $("#changeEmailBtn").click(function (event) {
        event.preventDefault();
        if ($("#changeEmail").val()) {
            const reg = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            let email = $("#changeEmail").val();
            console.log(email);
            if (reg.test(email)) {
                $.ajax({
                    url: './utilities/checkEmail.php',
                    type: 'POST',
                    data: {
                        email: email,
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == 1) {
                            $(".changeEmail").children(".errors").text("Există deja un cont cu acest email");
                        } else {
                            $(".changeEmail").children(".errors").text("");
                            $(window).scrollTop(0);

                            $("#changeEmailModal").show();
                            $("body").css("overflow", "hidden");

                            $.ajax({
                                url: "./utilities/generateCode.php",
                                method: "GET",
                                success: function (data) {
                                    // $("#generatedCode").text(data);
                                    var code = data;
                                    $.ajax({
                                        url: './utilities/PHPmailer/sendEmail.php',
                                        type: 'POST',
                                        data: {
                                            code: code,
                                            email: email
                                        },
                                        success: function () {

                                        }
                                    });
                                    $("#submitChangeEmail").click(function () {
                                        if (code) {
                                            if ($("#changeEmailConfirm").val()) {
                                                let confirm = $("#changeEmailConfirm").val();
                                                if (confirm === code) {
                                                    $.ajax({
                                                        url: './utilities/changeEmail.php',
                                                        type: 'POST',
                                                        data: {
                                                            email: email,
                                                        },
                                                        success: function () {
                                                            $("#changeEmailModal").hide();
                                                            $("body").css("overflow", "scroll");

                                                            $("#changeEmail").val();
                                                            $("#changeEmail").attr("placeholder", email);
                                                        }
                                                    });
                                                }
                                            }
                                        }
                                    });
                                }
                            })
                        }
                    }
                });

            } else {
                $(".changeEmail").children(".errors").text("Trebuie un email valid");
            }
        } else {
            $(".changeEmail").children(".errors").text("Nu poți insera un email vid");
        }
    });



    //selecting badges
    $(".badges").children("img").click(function (event) {
        let target = event.target;
        $(".badges").children("img").each(function () {
            if ($(this).is(target)) {
                var element = $(this);
                var id = $(this).attr("id");
                $.ajax({
                    url: './utilities/selectedReward.php',
                    type: 'POST',
                    data: {
                        reward_id: id,
                        type: 2,
                    },
                    success: function () {
                        element.addClass("selected");
                    }
                });
            } else {
                $(this).removeClass("selected");
            }
        });
    });
    //selecting titles

    $(".title_reward").click(function (event) {
        let target = event.target;
        $(".title_reward").each(function () {

            if ($(this).is(target)) {
                let title = $(this);
                var id = title.attr("id");
                $.ajax({
                    url: './utilities/selectedReward.php',
                    type: 'POST',
                    data: {
                        reward_id: id,
                        type: 1,
                    },
                    success: function (data) {
                        console.log(data);
                        title.addClass("selected");
                        $("#selectedTitle").text(title.text());
                    }
                });

            } else {
                $(this).removeClass("selected");
            }
        });
    });

});