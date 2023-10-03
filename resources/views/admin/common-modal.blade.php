<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    x
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text">Are you sure you want to<br>Delete </p>
                <div class="modal-btn d-flex ">
                    <a class="extra-btn" href="#" data-dismiss="modal">No</a>
                    <a class="download-btn" href="#" id="yes">Yes</a>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="department_view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Department Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-xxl-12">
                    <form id="updateDepartmentForm">
                    <div class="row">
                        <div class="mb-3 col-md-6 ">
                            <input type="hidden" name="id">
                            <label class="form-label">Full Name</label>
                            <input type="text" id="department" name="name" class="form-control">
                        </div>
                    </div>
                    <button><a class="download-btn mt-4">Save</a></button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="doctor_view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Doctor Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-xxl-12">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" readonly>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" readonly>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Gender</label>
                            <input type="text" id="gender" class="form-control" readonly>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Education</label>
                            <input type="text" id="education" class="form-control" readonly>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Address</label>
                            <input type="text" id="address" class="form-control" readonly>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Specialist</label>
                            <input type="text" id="specialist" class="form-control" readonly>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" id="phone_number" class="form-control" readonly>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Department</label>
                            <input type="text" id="department" class="form-control" readonly>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label">About</label>
                            <textarea class="form-control" id="about" readonly></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="doctor_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Doctor Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-xxl-12">
                    <form id="updateDoctorForm">
                    <div class="row">
                        <div class="mb-3 col-md-6 ">
                            <input type="hidden" name="id">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6 ">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6 ">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6 ">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select category" id="category">
                                <option selected disabled>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6 ">
                            <label class="form-label">Education</label>
                            <input type="text" name="education" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6 ">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6 ">
                            <label class="form-label">Specialist</label>
                            <select name="specialist" class="form-select category" id="category">
                                <option selected disabled>Select Speciality</option>
                                <option value="">Option1</option>
                                <option value="">Option2</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6 ">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6 ">
                            <label class="form-label">Image</label>
                            <input type="file" name="profile_photo" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6 ">
                            <label class="form-label">Department</label>
                            <select name="department" class="form-select category" id="category">
                                <option selected disabled>Select Department</option>
                                <option value="">Option1</option>
                                <option value="">Option2</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label">About</label>
                            <textarea name="about" class="form-control"></textarea>
                        </div>
                    </div>
                    <button><a class="download-btn mt-4">Save</a></button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
