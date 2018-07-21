$(document).ready(function () {
    $("#GeneralForm").validate({
        ignore: [],
        rules: {
            site_name: {
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
            address: {
                required: true
            },
            google: {
                url: true
            },
            facebook: {
                url: true
            },
            twitter: {
                url: true
            },
            instagram: {
                url: true
            },
            logo_image: {
                extension: "jpg|jpeg|png"
            },
            favicon_image: {
                extension: "jpg|jpeg|png"
            }
        }
    });
    $("#logo_image").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-logo').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    $("#favicon_image").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-favicon').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    $("#GeneralForm").submit(function () {
        if ($("#GeneralForm").valid()) {
            $('#preloader').show();
            $('#status').show();
        }
    });
});