$(document).ready(function () {
    $("#registrationForm").validate({
        rules: {
            full_name: "required",
            email: {
                required: true,
                email: true,
            },
            gender: "required",
            password: {
                required: true,
                minlength: 6,
            },
            c_password: {
                required: true,
                equalTo: "#password",
            },
        },
        messages: {
            full_name: "Please enter your full name",
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address",
            },
            gender: "Please select your gender",
            password: {
                required: "Please enter a password",
                minlength: "Your password must be at least 6 characters long",
            },
            c_password: {
                required: "Please confirm your password",
                equalTo: "Passwords do not match",
            },
        },
        submitHandler: function (form) {
            // Create a FormData object to serialize the form data
            var formData = new FormData(form);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Make an AJAX call to your registration endpoint
            $.ajax({
                url: "/api/register",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status === 201) {
                        toastr.success("Registration successful");
                        form.reset();
                    } else if (response.status === 422) {
                        if (response.data && response.data.email) {
                            const emailError = response.data.email[0];
                            $("#email").after(`<label id="email-error" class="error" for="email">${emailError}</label>`);
                        }
                    }
                },
                error: function (xhr, status, error) {
                        toastr.error("Registration failed: " + error);
                },
            });
        },
    });
});
