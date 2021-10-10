
$(document).ready(function () {
    //scrolling
    var navbarTop = $("nav").offset().top;

    var stickyNav = function () {
        var scrollTop = $(window).scrollTop(); // our current vertical position from the top

        // if we've scrolled more than the navigation, change its position to fixed to stick to top,
        // otherwise change it back to relative
        if (scrollTop > navbarTop) {
            $("nav").addClass("sticky");
            $(".profile").css("padding-top", "10vh");
            $(".forum_content").css("padding-top", "10vh");

        } else {
            $("nav").removeClass("sticky");
            $(".profile").css("padding-top", "0");
            $(".forum_content").css("padding-top", "0vh");

        }
    };


    $(window).scroll(function () {
        stickyNav();
    });
    //left menu hamburger
    $("#hamburger").click(function () {
        // $(".left_content_menu").toggle();
        if ($(".left_content_menu").hasClass("hide_items")) {
            $(".left_content_menu").removeClass("hide_items");
            $(".left_content_menu").addClass("menu_flex");
            $(".right_content").css("width", "80vw");
            $("nav").css("width", "76vw");
            $(".horizontal_slider").css("width", "76vw");
            $(".course_form").css("width", "76vw");
            $(".profile").css("width", "76vw");
            $(".menu_content").css("justify-content", "flex-start");
            $(".left_nav").css("justify-content", "flex-end");

        } else {
            $(".left_content_menu").addClass("hide_items");
            $(".left_content_menu").removeClass("menu_flex");
            $(".right_content").css("width", "95vw");
            $(".menu_content").css("justify-content", "center");
            $(".left_nav").css("justify-content", "center");
            $("nav").css("width", "91vw");
            $(".profile").css("width", "91vw");
            $(".horizontal_slider").css("width", "91vw");
            $(".course_form").css("width", "91vw");

        }
    });
    $("#hamburger").hover(function () {

        $("#hamb").css("fill", "#707070");

    }, function () {

        $("#hamb").css("fill", "white");

    });


    //slider

    $(".right-paddle").hover(function () {

        $("#right_paddle").css("fill", "#464646");

    }, function () {

        $("#right_paddle").css("fill", "#929292");

    });
    $(".left-paddle").hover(function () {

        $("#left_paddle").css("fill", "#464646");

    }, function () {

        $("#left_paddle").css("fill", "#929292");

    });
    var leftPaddle = $(".left-paddle");
    var rightPaddle = $(".right-paddle");
    // items dimensions
    var cardsLength = $('.card').length;
    var cardSize = $('.card').outerWidth(true);
    var LeftPaddleSize = $(".left-paddle").outerWidth(true);
    var RightPaddleSize = $(".right-paddle").outerWidth(true);
    // get some relevant size for the paddle triggering point
    var paddleMargin = 20;

    var getSliderSize = function () {
        return $('.horizontal_slider').outerWidth();
    }
    var sliderSize = getSliderSize();
    // the slider size is responsive and changes when the window resizes

    //try to resiz ebased on parent


    var visibleSize = sliderSize;
    // get total width of all  items
    var getCollectionSize = function () {
        return cardsLength * cardSize;
    };
    var collectionSize = getCollectionSize();
    var invisibleSize = collectionSize - sliderSize;
    // get how much have we scrolled to the left
    var getPosition = function () {
        return $('.collection').scrollLeft();
    };
    //hide or show paddles based on collection size
    if (invisibleSize <= 0) {
        $(".right-paddle").addClass('hidden');
        $(".collection").css("overflow-x", "hidden");
    } else {
        $(".right-paddle").removeClass('hidden');
        $(".collection").css("overflow-x", "scroll");
    }
    $(window).resize(function () {
        var collectionSize = getCollectionSize();
        var invisibleSize = collectionSize - sliderSize;
        sliderSize = getSliderSize();
        if (invisibleSize <= 0) {
            $(".right-paddle").addClass('hidden');
            $(".collection").css("overflow-x", "hidden");

        } else {
            $(".right-paddle").removeClass('hidden');
            $(".collection").css("overflow-x", "scroll");
        }
    });

    //when scrolling
    $('.collection').scroll(function () {
        // get how much have we scrolled so far
        var position = getPosition();

        var endOffset = invisibleSize - paddleMargin;

        // show & hide the paddles 
        // depending on scroll position
        if (position <= paddleMargin) {
            $(".left-paddle").addClass('hidden');
            $(".right-paddle").removeClass('hidden');
        } else if (position < endOffset) {
            // show both paddles in the middle
            $(".left-paddle").removeClass('hidden');
            $(".right-paddle").removeClass('hidden');
        } else if (position >= endOffset) {
            $(".left-paddle").removeClass('hidden');
            $(".right-paddle").addClass('hidden');

        }
    });

    // scroll to left
    $(rightPaddle).click(function () {
        if ($(".left-paddle").hasClass("hidden")) {
            $('.collection').animate({ scrollLeft: $('.collection').scrollLeft() + cardSize + LeftPaddleSize });
        } else {
            $('.collection').animate({ scrollLeft: $('.collection').scrollLeft() + cardSize });
        }

    });

    // scroll to right
    $(leftPaddle).click(function () {
        $('.collection').animate({ scrollLeft: $('.collection').scrollLeft() - cardSize });
    });



    //closing modals
    $(document).on("click", "#close", function () {
        $("body").css("overflow-y", "scroll");
        $("#myModal").hide();
        $("#chooseCover").hide();
        $("#chooseProfile").hide();
        $(".modal_post").remove();
        $("#congratulations").remove();
        $("#changeEmailModal").hide();
    });
    $(window).click(function (event) {
        if ($(event.target).is(".modal")) {
            $("#myModal").remove();
            $("#chooseCover").hide();
            $("#chooseProfile").hide();
            $("#changeEmailModal").hide();
            $("#congratulations").remove();
            $(".modal_post").remove();
            $("body").css("overflow", "scroll");
        }
    });
    $(document).on("click", ".close", function () {
        $("#congratulations").remove();
        $("body").css("overflow-y", "scroll");
    });
    //progress bars
    $(window).ready(function (e) {
        $(".myBar").each(function () {
            var i = 0;
            if (i == 0) {
                i = 1;
                var elem = $(this);
                var width = 0;
                var progress = elem.attr("id");
                var id = setInterval(frame, 20);
                function frame() {
                    if (width >= progress) {
                        clearInterval(id);
                        i = 0;
                    } else {
                        width++;
                        elem.css("width", width + "%");
                    }
                }
            }
        });
    });
});



