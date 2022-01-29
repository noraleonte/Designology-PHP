$(document).ready(function () {

    $(".chapterlink").click(function () {
        let outerThis = $(this).closest(".chapter");
        $(outerThis).find(".subsections").slideToggle(500);
        $(outerThis).find(".chapterthumbnail").toggle();
        $(outerThis).find(".chapterintro").toggle();
        // $(outerThis).find(".chaptertitle").css("font-size", "36px");
        $(this).text($(this).text() == 'Mai mult' ? 'Mai putin' : 'Mai mult');

    });
    $(".complete").click(function (event) {
        chapter_id = event.target.id;
        chapter = $(this);
        complete = $(this)
        $.ajax({
            url: 'utilities/updateChapterProgress.php',
            type: 'POST',
            data: {
                chapter_id: chapter_id
            },
            success: function (data) {

                outerThis = chapter.closest(".chapter");
                $(outerThis).children(".subsections").hide();
                $(outerThis).find(".chapterthumbnail").show();
                $(outerThis).find(".chapterintro").show();
                $(outerThis).find(".chapterlink").text("Mai mult");
                $("#chapter_status" + chapter_id).text(" - Completat");
                complete.hide();
                $(window).scrollTop(0);
                if (data) {
                    $("body").css("overflow", "hidden");
                    $(".chapters").append(data);
                }

            }
        });
    });
});