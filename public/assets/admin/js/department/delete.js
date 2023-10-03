

$(document).ready(function(){
    $(document).on('click','.deleteDepartment',function(e){
        e.preventDefault();

        var departmentId = $(this).data('department_id');

        var departmentModal = $("#delete-modal");

        departmentModal.find('#yes').attr('data-id',departmentId);

        departmentModal.modal('show');
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
            url: "/admin/delete/department",
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
