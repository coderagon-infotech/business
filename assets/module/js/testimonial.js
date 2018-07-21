$(document).ready(function () {
    $("#TestimonialForm").validate({
        rules: {
            name: {
                required: true
            },
            position: {
                required: true
            },
            description: {
                required: true,
            }
        }
    });
    $("#TestimonialForm").submit(function () {
        if ($("#TestimonialForm").valid()) {
            $('#preloader').show();
            $('#status').show();
        }
    });
});
function delete_record(e) {
    alertify.confirm("Are you sure you want to delete this record?").then(function (resolvedValue) {
        resolvedValue.event.preventDefault();
        if (resolvedValue.buttonClicked == 'ok') {
            var token = $(e).attr("data-token");
            $.ajax({
                type: "POST",
                url: site_url + 'backend/testimonial/delete_testimonial/' + token,
                data: {themes_token: csrf_token},
                beforeSend: function () {
                    $('#preloader').show();
                    $('#status').show();
                },
                success: function (result) {
                    window.location.reload();
                }
            });
        }
    });
}