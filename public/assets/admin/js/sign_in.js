$(document).ready(function () {
    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address",
            },
            password: {
                required: "Please enter your password",
            },
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/sign-in",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        window.location.href = "/admin/";
                    } else {
                        toastr.error("Login failed: " + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    if (xhr.responseJSON) {
                        const response = xhr.responseJSON;
                        if (response.status === 401) {
                            toastr.error("Invalid Credentials");
                        } else {
                            toastr.error("Login failed: " + response.message);
                        }
                    } else {
                        toastr.error("An error occurred while logging in.");
                        console.error(xhr.responseText);
                    }
                },
            });
        },
    });
});
