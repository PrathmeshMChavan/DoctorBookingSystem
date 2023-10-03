$(document).ready(function () {
    // Function to update the state of #checkAll
    function updateCheckAllState() {
        var allCheckboxes = $("input[name='time_array[]']");
        var allChecked = allCheckboxes.length === allCheckboxes.filter(":checked").length;
        $("#checkAll").prop('checked', allChecked);
    }

    // Initial check when the page loads
    updateCheckAllState();

    // Event handler for individual checkboxes
    $(document).on('change', "input[name='time_array[]']", function () {
        updateCheckAllState();
    });

    // Event handler for #checkAll
    $(document).on('change', "#checkAll", function () {
        var checkAllChecked = $(this).prop('checked');
        $("input[name='time_array[]']").prop('checked', checkAllChecked);
    });

    $("#updateAppointmentForm").validate({
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
                url: "/doctor/update/appointments",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    if (response.status == 200) {
                        toastr.success(response.message);
                        window.location.reload();
                    } else if (response.status === 422) {
                        // toastr.error("Appointments already created for this date");
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
