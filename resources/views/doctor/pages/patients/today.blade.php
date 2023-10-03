@extends('doctor.layouts.master')
@section('content')
    @php
        $currentPage = 'patient_tdys';
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
                <div class="middle-content container-xxl p-0">
                    <div class="row layout-top-spacing ">
                        <div class="top-tabel">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="card-title">Appointment</h6>
                                </div>
                                <div class="col-md-8">

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                            <div class="widget-content widget-content-area br-8 position-btn">
                                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="text-center">Sr.no</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Gender</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($appointments as $appointment)
                                        <tr>
                                            <td class="">{{ $loop->iteration }}</td>
                                            <td class="">{{ $appointment->patient->full_name }}</td>
                                            <td>{{ date('d/m/Y', strtotime($appointment->appointment->date)) }}</td>
                                            <td class="">{{ $appointment->patient->email }}</td>
                                            <td>{{ $appointment->patient->phone_number }}</td>
                                            <td>{{ $appointment->patient->gender }}</td>
                                            <td>{{ date('g:i a', strtotime($appointment->appointment->time)) }}</td>
                                            <td>
                                                <select name="status" data-id="{{ $appointment->id }}" class="updateStatus">
                                                    <option selected disabled>Appointment Status</option>
                                                    <option {{ $appointment->status == 'approve' ? 'selected' : '' }} value="approve">Approve</option>
                                                    <option {{ $appointment->status == 'cancel' ? 'selected' : '' }} value="cancel">Cancel</option>
                                                    <option {{ $appointment->status == 'reject' ? 'selected' : '' }} value="reject">Reject</option>
                                                </select>
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
<script src="{{ asset('assets/doctor/js/patients/appointment_status.js') }}"></script>
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
