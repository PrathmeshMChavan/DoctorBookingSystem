$(document).ready(function(){
    $(document).on('click','.editDepartment',function(e){
        e.preventDefault();

        var departmentId = $(this).data('department_id');
        var departmentName = $(this).data('department_name');
        var departmentModal = $('#department_view_modal');
        departmentModal.find('input[name="id"]').val(departmentId);
        departmentModal.find('input[name="name"]').val(departmentName);
        departmentModal.modal('show');
    });

        $("#updateDepartmentForm").validate({
            rules: {
                id: "required",
                name: "required"
            },
            messages: {
                name: "Please enter department name"
            },
            submitHandler: function (form) {
                var formData = new FormData(form);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/admin/department/update/",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status === 200) {
                            toastr.success(response.message);
                            window.location.reload();
                        } else if (response.status === 422) {
                            if (response.data && response.data.name) {
                                const departmentError = response.data.name[0];
                                $("#department").after(`<label id="department-error" class="error" for="department">${departmentError}</label>`);
                            }
                        }
                    },
                    error: function (xhr, status, error) {
                            toastr.error("Updating Department failed");
                    },
                });
            },
        });
});
