@extends('admin.layouts.master')
@section('content')
    @php
        $currentPage = 'department_create';
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
                                <h6 class="card-title pl-0">Department > Create</h6>

                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                            <div class="widget-content widget-content-area br-8 position-btn px-3 py-4">
                                <div
                                    id="zero-config_wrapper"class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer department">
                                    <h2>Add Department</h2>
                                    <divider></divider>
                                    <form id="departmentAddForm">
                                        <div class="mb-3 col-md-6 p-0">
                                            <label class="form-label">Department Name</label>
                                            <input type="text" id="department" name="name" class="form-control">
                                        </div>
                                        <button><a class="download-btn w-100">Submit</a></button>
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
    <script src="{{ asset('assets/admin/js/department/add.js') }}"></script>
@endsection
