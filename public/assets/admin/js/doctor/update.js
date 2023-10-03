$(document).ready(function () {
    $("#updateDoctorForm").validate({
        rules: {
            full_name: "required",
            email: {
                required: true,
                email: true,
            },
            gender: "required",
            password: {
                minlength: 8,
            },
            education: "required",
            address: "required",
            specialist: {
                required: true,
                min: 1, // Ensures that at least one option is selected
            },
            department: {
                required: true,
                min: 1, // Ensures that at least one option is selected
            },
            phone_number: {
                required: true,
            },
            about: "required",
        },
        messages: {
            full_name: "Please enter the full name",
            email: {
                required: "Please enter an email address",
                email: "Please enter a valid email address",
            },
            gender: "Please select the gender",
            password: {
                minlength: "Password must be at least 8 characters long",
            },
            education: "Please enter education information",
            address: "Please enter the address",
            specialist: {
                required: "Please select a specialist",
                min: "Please select a specialist",
            },
            department: {
                required: "Please select a department",
                min: "Please select a department",
            },
            phone_number: {
                required: "Please enter a phone number",
            },
            about: "Please provide information about the doctor",
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/doctor/update", // Replace with your actual Laravel update route
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status === 200) {
                        toastr.success("Doctor updated successfully");
                        window.location.href = '/admin/doctor'; // Redirect to the doctor list page
                    }
                },
                error: function (xhr, status, error) {
                    if (xhr.responseJSON) {
                        const response = xhr.responseJSON;
                        if (response.status === 422) {
                            $.each(response.errors, function (key, value) {
                                $("#" + key).after(`<label class="error" for="${key}">${value[0]}</label>`);
                            });
                        }
                    } else {
                        toastr.error("Doctor update failed: " + error);
                    }
                },
            });
        },
    });
});
