$(document).ready(function () {
    $("#BannerForm").validate({
        ignore: [],
        rules: {
            title: {
                required: true
            },
            sub_title: {
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
    $("#BannerForm").submit(function () {
        if ($("#BannerForm").valid()) {
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
                url: site_url + 'backend/banner/delete_banner/' + token,
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