$(document).ready(function(){
    $(document).on('click','.delete_doctor',function(e){
        e.preventDefault();

        var doctorId = $(this).data('id');

        var doctorModal = $("#delete-modal");

        doctorModal.find('#yes').attr('data-id',doctorId);

        doctorModal.modal('show');
    });

    $(document).on("click", "#yes", function (e) {
        e.preventDefault();
        var id = $(this).data("id");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: "/admin/delete/doctor",
            method: "DELETE",
            data: {
                id: id
            },
            success: function (response) {
                if(response.status == 200)
                {
                    toastr.success(response.message);

                    window.location.reload();
                }
                else if(response.status == 500)
                {
                    toastr.error(response.message);
                }
            },
            error: function (xhr, status, error) {
                toastr.error("Failed to Archive. Please try again.");
            },
        });
    });
});
