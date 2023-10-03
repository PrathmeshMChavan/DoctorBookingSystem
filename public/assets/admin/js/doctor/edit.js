$(document).ready(function(){
    $(document).on('click','.edit_doctor', function(e){
        e.preventDefault();

        var doctorData = $(this).data('doctor_data');
        var departmentList = $(this).data('department_list');
        var specialistList = $(this).data('specialist_list');
        var doctorModal = $("#doctor_edit_modal");
        doctorModal.find('input[name="id"]').val(doctorData['id']);
        doctorModal.find('input[name="full_name"]').val(doctorData['full_name']);
        doctorModal.find('input[name="email"]').val(doctorData['email']);

        // Set the selected value for gender
        var genderSelect = doctorModal.find('select[name="gender"]');
        genderSelect.val(doctorData['gender']);

        doctorModal.find('input[name="education"]').val(doctorData['doctor_profile']['education']);
        doctorModal.find('input[name="address"]').val(doctorData['address']);
        doctorModal.find('input[name="phone_number"]').val(doctorData['phone_number']);
        doctorModal.find('textarea[name="about"]').val(doctorData['about']);

        // Populate the Specialist dropdown
        var specialistSelect = doctorModal.find('select[name="specialist"]');
        specialistSelect.empty();
        specialistSelect.append('<option selected disabled>Select Speciality</option>');
        $.each(specialistList, function(index, specialist) {
            specialistSelect.append('<option value="' + specialist.id + '">' + specialist.name + '</option>');
        });
        specialistSelect.val(doctorData['doctor_profile']['specialist_id']); // Set the selected value

        // Populate the Department dropdown
        var departmentSelect = doctorModal.find('select[name="department"]');
        departmentSelect.empty();
        departmentSelect.append('<option selected disabled>Select Department</option>');
        $.each(departmentList, function(index, department) {
            departmentSelect.append('<option value="' + department.id + '">' + department.name + '</option>');
        });
        departmentSelect.val(doctorData['doctor_profile']['department_id']); // Set the selected value

        doctorModal.modal('show');
    });
});
