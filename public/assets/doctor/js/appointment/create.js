$(document).ready(function () {
    $(document).on('change', "#checkAll", function () {
        var checkAllChecked = $(this).prop('checked');
        $("input[name='time_array[]']").prop('checked', checkAllChecked);
    });

    $("#createAppointmentForm").validate({
        rules: {
            date: {
                required: true
            },
            "time_array[]": {
                required: true
            },
        },
        messages: {
            date: {
                required: "Please select a date",
            },
            "time_array[]": {
                required: "Please select at least one time slot",
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
                url: "/doctor/create/appointments",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    if (response.status == 200) {
                        toastr.success(response.message);
                        form.reset();
                    } else if (response.status === 422) {
                        toastr.error("Appointments already created for this date");
                    } else {
                        toastr.error("Error: " + response.message);
                    }
                },
                error: function (xhr, status, error) {
                },
            });
        },
    });
});
