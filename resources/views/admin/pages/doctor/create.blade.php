@extends('admin.layouts.master')
@section('content')
    @php
        $currentPage = 'doctor_create';
    @endphp
<!-- BEGIN LOADER -->
<div id="load_screen">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div>
    </div>
</div>
<!--  END LOADER -->
<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="middle-content container-xxl ">
                <div class="row layout-top-spacing ">
                    <div class="top-tabel">
                        <div class="title">
                            <h6 class="card-title pl-0">Doctor > Create</h6>

                        </div>
                    </div>


                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-8 position-btn px-3 py-4">
                            <div id="zero-config_wrapper"class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer department">
                                <h2>Add Doctor</h2>
                                <divider></divider>
                                <form id="addDoctorForm" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="mb-3 col-md-6 ">
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
                                        @foreach ($specialists as $specialist)
                                        <option value="{{ $specialist->id }}">{{ $specialist->name }}</option>
                                        @endforeach
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
                                        @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">About</label>
                                    <textarea name="about" class="form-control"></textarea>
                                </div>

                                </div>
                                <div class="btns-drc">
                                    <button><a class="download-btn w-100">Submit</a></button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/admin/js/doctor/add.js') }}"></script>
@endsection
