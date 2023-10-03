$(document).ready(function () {
    $("#departmentAddForm").validate({
        rules: {
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
                url: "/admin/department/store",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status === 200) {
                        toastr.success(response.message);
                        form.reset();
                    } else if (response.status === 422) {
                        if (response.data && response.data.name) {
                            const departmentError = response.data.name[0];
                            $("#department").after(`<label id="department-error" class="error" for="department">${departmentError}</label>`);
                        }
                    }
                },
                error: function (xhr, status, error) {
                    if (xhr.responseJSON) {
                        const response = xhr.responseJSON;
                        // if (response.status === 422) {
                        //     if (response.data && response.data.name) {
                        //         const departmentError = response.data.name[0];
                        //         $("#department").after(`<label id="name-error" class="error" for="name">${departmentError}</label>`);
                        //     }
                        // }
                    } else {
                        toastr.error("Adding Department failed");
                    }
                },
            });
        },
    });
});
