$(document).ready(function () {
    $("#LoginForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
            }
        }
    });
});
$("#LoginForm").submit(function () {
    if ($("#LoginForm").valid()) {
        $('#preloader').show();
        $('#status').show();
    }
});