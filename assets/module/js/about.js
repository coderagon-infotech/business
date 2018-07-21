$(document).ready(function () {
    $("#AboutForm").validate({
        ignore: [],
        rules: {
            title: {
                required: true
            },
            description: {
                required: true
            },
            sort: {
                required: true,
                number: true
            },
            image: {
                extension: "jpg|jpeg|png"
            }
        }
    });
    $("#image").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    $("#AboutForm").submit(function () {
        if ($("#AboutForm").valid()) {
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
                url: site_url + 'backend/about/delete_about/' + token,
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