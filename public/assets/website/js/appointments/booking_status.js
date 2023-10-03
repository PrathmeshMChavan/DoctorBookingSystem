$(document).ready(function(){
    $(document).on('change', '.updateStatus', function(){
        var id = $(this).data('id');
        var status = $(this).val();

        $.ajax({
            url: "/status/appointment",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                id: id,
                status: status
            },
            success: function (response) {
                if (response.status == 200) {
                    toastr.success(response.message);
                    window.location.reload();
                } else {
                    toastr.error(response.data);
                }
            },
            error: function (xhr, status, error) {
                toastr.error("Status change failed: " + error);
            },
        });
    });
});
