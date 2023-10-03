$(document).ready(function () {
    $("#profileForm").validate({
        rules: {
            name: "required",
            address: "required",
            phone_number: "required",
            gender: "required",
            bio: 'required'
        },
        messages: {
            name: {
                required: "Please enter your name"
            },
            address: {
                required: "Please enter your address"
            },
            phone_number: {
                required: "Please enter your phone number"
            },
            gender: {
                required: "Please select your gender"
            },
            bio: {
                required: "Please provide some information about yourself"
            }
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/update/profile",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status === 200) {
                        toastr.success("Profile updated Successfully");
                    }
                },
                error: function (xhr, status, error) {
                        toastr.error("Registration failed: " + error);
                },
            });
        },
    });
});
