function delete_record(e) {
    alertify.confirm("Are you sure you want to delete this record?").then(function (resolvedValue) {
        resolvedValue.event.preventDefault();
        if (resolvedValue.buttonClicked == 'ok') {
            var token = $(e).attr("data-token");
            $.ajax({
                type: "POST",
                url: site_url + 'backend/contact/delete_contact/' + token,
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