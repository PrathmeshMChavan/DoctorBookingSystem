@extends('doctor.layouts.master')
@section('content')
    @php
        $currentPage = 'appointment_view';
    @endphp<!-- BEGIN LOADER -->
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
                                <h6 class="card-title pl-0">Doctor > Appointment Time</h6>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                            <div class="widget-content widget-content-area br-8 position-btn px-3 py-4">
                                <div
                                    id="zero-config_wrapper"class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer department">
                                    <h2>Check Appointment</h2>
                                    <divider></divider>
                                    <form method="POST" action="{{ route('doctor.edit.appointment') }}">
                                        @csrf
                                    <div class="mb-3 col-md-6 p-0">
                                        <label class="form-label">Date</label>
                                        <input type="date" name="date" class="form-control">
                                    </div>
                                    <button><a class="download-btn w-100">Check</a></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                            <div class="widget-content widget-content-area br-8 position-btn">
                                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="text-center">Sr.no</th>
                                            <th>Date</th>
                                            <th>View/Update</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($slots as $slot)
                                        <tr>
                                            <td class="">{{ $loop->iteration }}</td>
                                            <td>{{ $slot->date }}</td>
                                            <td>
                                                <form action="{{ route('doctor.edit.appointment') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="date" value="{{ $slot->date }}">
                                                <button><a class="pending-btn">View/Update</a></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/doctor/js/appointment/check.js') }}"></script>
    <script>
        $('#zero-config').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10
        });
    </script>
@endsection
