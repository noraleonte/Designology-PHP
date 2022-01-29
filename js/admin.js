$(document).ready(function () {

    $(document).on("change", "#selectUser", function () {
        $("#success").text("");
        url = $(this).val();
        $.ajax({
            url: 'utilities/getStatus.php',
            type: 'POST',
            data: {
                url: url
            },
            success: function (data) {
                $("#selectStatus").prop("disabled", false);
                $("#selectStatus").attr("name", url);
                $("#selectStatus").val(data);
            }
        });
    });
    $(document).on("change", "#selectStatus", function () {
        url = $(this).attr("name");
        status = $(this).val();
        $.ajax({
            url: 'utilities/setStatus.php',
            type: 'POST',
            data: {
                url: url,
                status: status
            },
            success: function () {
                $("#success").text("Schimbare realizată cu succes!");

                $("#selectStatus").prop("disabled", true);
                $("#selectUser").val(0);
                $("#selectStatus").val(0);
            }
        });
    });
});