$(document).ready(function () {
    $("#TeamForm").validate({
        ignore: [],
        rules: {
            name: {
                required: true
            },
            position: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
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
    $("#TeamForm").submit(function () {
        if ($("#TeamForm").valid()) {
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
                url: site_url + 'backend/team/delete_team/' + token,
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