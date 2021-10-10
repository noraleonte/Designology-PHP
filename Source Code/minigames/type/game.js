$(document).ready(function () {


    $("button").mousedown(function () {
        $(this).css("box-shadow", "inset 0 0 3px #000000");
    });
    $("button").mouseup(function () {
        $(this).css("box-shadow", "none");
    });

    $(".editable").click(function () {
        target = $(this);
        $(".game_inputs").show();

        font = target.css("font-family");
        size = target.css("font-size");
        size = parseInt(size);
        weight = target.css("font-weight");
        rgb = target.css("color");

        rgb = rgb.substr(4);
        rgb = rgb.slice(0, -1);
        rgb = rgb.split(',');

        color = "#";
        color = color + parseInt(rgb[0], 10).toString(16) + parseInt(rgb[1], 10).toString(16) + parseInt(rgb[2], 10).toString(16);
        style = target.css("font-style");
        decoration = target.css("text-decoration");
        transform = target.css("text-transform");
        alignment = target.css("text-align");
        console.log(alignment);

        $("#selectFont option[value=" + font + "]").prop("selected", true);
        $("#changeSize").val(size);
        $("#selectWeight").val(weight);
        $("#changeColor").val(color);
        if (style == "italic") {
            $("#italic").addClass("selected");
        }
        if (decoration == "underline") {
            $("#underlined").addClass("selected");
        } else {
            $("#underlined").removeClass("selected");

        }
        if (transform == "uppercase") {
            $("#uppercase").addClass("selected");
            $("#capital").removeClass("selected");

        } else if (transform == "capitalize") {
            $("#capital").addClass("selected");
            $("#uppercase").removeClass("selected");

        } else {
            $("#uppercase").removeClass("selected");
            $("#capital").removeClass("selected");
        }

        if (alignment == "left" || alignment == "start") {
            $("#leftalign").addClass("selected");
            $("#rightalign").removeClass("selected");
            $("#center").removeClass("selected");
            $("#justify").removeClass("selected");

        }
        if (alignment == "right") {
            $("#rightalign").addClass("selected");
            $("#leftalign").removeClass("selected");
            $("#center").removeClass("selected");
            $("#justify").removeClass("selected");

        }
        if (alignment == "center") {
            $("#center").addClass("selected");
            $("#rightalign").removeClass("selected");
            $("#leftalign").removeClass("selected");
            $("#justify").removeClass("selected");

        }
        if (alignment == "justify") {
            $("#justify").addClass("selected");
            $("#center").removeClass("selected");
            $("#rightalign").removeClass("selected");
            $("#leftalign").removeClass("selected");
        }

        $("#selectFont").change(function () {
            font = $(this).val();
            target.css("font-family", font);
        });
        $("#changeSize").change(function () {
            size = $(this).val();
            target.css("font-size", size + "px");
        });
        $("#selectWeight").change(function () {
            weight = $(this).val();
            target.css("font-weight", weight);
        });
        $("#changeColor").change(function () {
            color = $(this).val();
            target.css("color", color);
        });


        $("#italic").click(function () {
            if ($(this).hasClass("selected")) {
                $(this).removeClass("selected");
                target.css("font-style", "normal");
            } else {
                $(this).addClass("selected");
                target.css("font-style", "italic");
            }
        });
        $("#underlined").click(function () {
            if ($(this).hasClass("selected")) {
                $(this).removeClass("selected");
                target.css("text-decoration", "none");
            } else {
                $(this).addClass("selected");
                target.css("text-decoration", "underline");
            }
        });
        $("#uppercase").click(function () {
            if ($(this).hasClass("selected")) {
                $(this).removeClass("selected");
                target.css("text-transform", "none");
            } else {
                $(this).addClass("selected");
                $("#capital").removeClass("selected");
                target.css("text-transform", "uppercase");
            }
        });
        $("#capital").click(function () {
            if ($(this).hasClass("selected")) {
                $(this).removeClass("selected");
                target.css("text-transform", "none");
            } else {
                $(this).addClass("selected");
                $("#uppercase").removeClass("selected");
                target.css("text-transform", "capitalize");
            }
        });
        $(".align").click(function (event) {
            align = $(event.target);
            console.log(align);
            if (align.hasClass("selected")) {
                align.removeClass("selected");
                target.css("text-align", "initial");
            } else {
                $(".align").each(function () {
                    if (align.is($(this))) {
                        $(this).addClass("selected");
                    } else {
                        $(this).removeClass("selected");
                    }
                });
                if (align.attr("id") == "leftalign") {
                    target.css("text-align", "left");

                } else if (align.attr("id") == "rightalign") {
                    target.css("text-align", "right");

                } else if (align.attr("id") == "center") {
                    target.css("text-align", "center");

                } else {
                    target.css("text-align", "justify");

                }
            }
        });

    });
});