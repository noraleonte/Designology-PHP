$(document).ready(function () {
    //showing only the user's posts
    if ($("#selectTopic").hasClass("own")) {
        user = 1;
    } else {
        user = 0;
    }
    //showing only the posts the user liked
    if ($("#selectTopic").hasClass("liked")) {
        liked = 1;
    } else {
        liked = 0;
    }
    //showing posts with ajax
    $.ajax({
        url: 'utilities/showPosts.php',
        type: 'POST',
        data: {
            topic: -1,
            user: user,
            liked: liked
        },
        success: function (data) {
            $(".sort_filter").after(data);
        }
    });
    //filter posts by topic
    $("#selectTopic").change(function () {
        if ($(this).hasClass("own")) {
            user = 1;
        } else {
            user = 0;
        }
        if ($(this).hasClass("liked")) {
            liked = 1;
        } else {
            liked = 0;
        }
        topic = $(this).val();
        $.ajax({
            url: 'utilities/showPosts.php',
            type: 'POST',
            data: {
                topic: topic,
                user: user,
                liked: liked
            },
            success: function (data) {
                $(".recent_posts").remove();
                $(".sort_filter").after(data);
            }
        });
    });
    //filter shown posts by trending topic
    $(document).on("click", ".topic", function (event) {
        target = $(event.target);
        id = $(this).attr("id");
        $("#selectTopic").val(id).trigger("change");
        $(".topic").each(function () {
            if ($(this).is(target)) {
                $(this).addClass("selected");
            } else {
                $(this).removeClass("selected");

            }
        });

    });
    //showing detailed post (opening modal)
    $(document).on("click", ".post", function (event) {
        if ($(event.target).is("#appreciate_svg") || $(event.target).is(".appreciate") || $(event.target).is("path") || $(this).hasClass("modal")) {
        } else {
            post_id = $(this).attr("id");
            $.ajax({
                url: 'utilities/detailedPost.php',
                type: 'POST',
                data: {
                    post_id: post_id,
                },
                success: function (data) {
                    $("body").css("overflow", "hidden");
                    $(window).scrollTop(0);
                    $("body").append(data);
                    $(".multiple_comments").scrollTop($(".multiple_comments").height());
                }
            });
        }

    });
    //adding a comment
    $(document).on("click", "svg.add_comment", function () {
        if ($("input.comment_content").val()) {
            let empty = /^[\s]+$/;
            if (empty.test($(".comment_content").val())) {
                $(".new_comment").after("<p class=\"errors\" id=\"empty_comment\">Trebuie să scrii ceva!</p>");
            } else {
                $("#empty_comment").remove();
                content = $("input.comment_content").val();
                post_id = $("input.comment_content").attr("id");
                $.ajax({
                    url: 'utilities/addComment.php',
                    type: 'POST',
                    data: {
                        content: content,
                        post_id: post_id
                    },
                    success: function (data) {
                        $("input.comment_content").val("");
                        $(".multiple_comments").append(data);
                        $(".multiple_comments").scrollTop($(".multiple_comments").height());

                    }
                });
            }
        } else {
            $(".new_comment").after("<p class=\"errors\" id=\"empty_comment\">Trebuie să scrii ceva!</p>");
        }
    });
    //liking a post
    $(document).on("click", ".appreciate", function (event) {

        post_id = $(this).closest(".post").attr("id");
        like = $(this);
        if ($(this).hasClass("appreciated")) {
            $.ajax({
                url: 'utilities/unlikePost.php',
                type: 'POST',
                data: {
                    post_id: post_id,
                },
                success: function () {
                    like.removeClass("appreciated");
                    no = like.siblings(".stats").children(".likes_number");
                    if (no.text() == "O") {
                        no.text(0);
                        no.siblings("span").text("APRECIERI");
                    } else if (no.text() == "DOUĂ") {
                        no.text("O");
                        no.siblings("span").text("APRECIERE");
                    } else if (no.text() == 3) {
                        no.text("DOUĂ");
                        no.siblings("span").text("APRECIERI");
                    } else {
                        numeric_no = parseInt(no.text()) - 1
                        no.text(numeric_no);
                        no.siblings("span").text("APRECIERI");
                    }
                }
            });
        } else {
            $.ajax({
                url: 'utilities/likePost.php',
                type: 'POST',
                data: {
                    post_id: post_id,
                },
                success: function () {
                    like.addClass("appreciated");
                    no = like.siblings(".stats").children(".likes_number");
                    if (no.text() == "O") {
                        no.text("DOUĂ");
                        no.siblings("span").text("APRECIERI");
                    } else if (no.text() == "DOUĂ") {
                        no.text(3);
                        no.siblings("span").text("APRECIERI");
                    } else if (no.text() == 0) {
                        no.text("O");
                        no.siblings("span").text("APRECIERE");
                    } else {
                        numeric_no = parseInt(no.text()) + 1
                        no.text(numeric_no);
                        no.siblings("span").text("APRECIERI");
                    }
                }
            });

        }
    });
    //creating a new post
    $("#post_button").click(function () {
        if ($("textarea#post_content").val()) {
            let empty = /^[\s]+$/;
            if (empty.test($("textarea#post_content").val())) {
                $(".new_post").after("<p class=\"errors\" id=\"empty_post\">Trebuie să scrii ceva!</p>");
            } else {
                $("#empty_post").remove();
                ok = 0;
                $(".category").each(function () {
                    if ($(this).hasClass("selected")) {
                        ok = 1;
                        cat = $(this);
                        cat_id = $(this).attr("id");
                    }
                });
                if (ok == 1) {
                    $("#empty_cat").remove();
                    content = $("textarea#post_content").val();
                    $.ajax({
                        url: 'utilities/setPosts.php',
                        type: 'POST',
                        data: {
                            content: content,
                            topic: cat_id
                        },
                        success: function (data) {
                            cat.removeClass("selected");
                            $("textarea#post_content").val("");
                            if (data) {
                                $("#selectTopic").val(cat_id).trigger("change");
                                $(".sort_filter").after(data);
                            }

                        }
                    });
                } else {
                    $(".new_post").after("<p class=\"errors\" id=\"empty_cat\">Trebuie să selectezi o categorie!</p>");
                }
            }

        } else {
            $(".new_post").after("<p class=\"errors\" id=\"empty_post\">Trebuie să scrii ceva!</p>");

        }
    });

    //selecting new post category
    $(".category").click(function (event) {
        let target = event.target;
        $(".category").each(function () {
            if ($(this).is(target)) {
                $(this).addClass("selected");
            } else {
                $(this).removeClass("selected");
            }
        });
    });
    $(document).on("click", "#close", function () {
        $("#selectTopic").val(-1).trigger("change");


    });
    $(window).click(function (event) {
        if ($(event.target).is(".modal")) {
            $("#selectTopic").val(-1).trigger("change");
        }
    });
});