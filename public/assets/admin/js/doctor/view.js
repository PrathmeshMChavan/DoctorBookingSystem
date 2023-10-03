$(document).ready(function(){
    $(document).on('click','.view_doctor', function(e){
        e.preventDefault();

        var doctorData = $(this).data('doctor_data');
        var doctorModal = $("#doctor_view_modal");
        doctorModal.find('#full_name').val(doctorData['full_name']);
        doctorModal.find('#email').val(doctorData['email']);
        doctorModal.find('#gender').val(doctorData['gender']);
        doctorModal.find('#education').val(doctorData['doctor_profile']['education']);
        doctorModal.find('#address').val(doctorData['address']);
        doctorModal.find('#specialist').val(doctorData['doctor_profile']['department']['name']);
        doctorModal.find('#department').val(doctorData['doctor_profile']['specialist']['name']);
        doctorModal.find('#phone_number').val(doctorData['phone_number']);
        doctorModal.find('#about').val(doctorData['about']);
        doctorModal.modal('show');
    });
});
