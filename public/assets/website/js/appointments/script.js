$(document).ready(function(){
    $(document).on('click','.time-btn',function(e){
        e.preventDefault();
        var slotId = $(this).data('slot_id');
        var patient_id = $(this).data('patient_id');
        $.ajax({
            url: "/api/book/slot", // Replace with your server endpoint
            type: "POST", // Adjust the HTTP method as needed (e.g., 'GET' or 'POST')
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                slotId: slotId,
                patientId: patient_id
            },
            success: function (response) {
                console.log(response);
                if(response.status == 200)
                {
                    toastr.success(response.message);
                }
                else
                {
                    toastr.error(response.data)
                }
            },
            error: function (xhr, status, error) {
                toastr.error("Registration failed: " + error);
            },
        });
    });

    
});
