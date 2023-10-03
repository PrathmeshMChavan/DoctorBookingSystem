@extends('doctor.layouts.master')
@section('content')
    @php
        $currentPage = 'appointment_create';
    @endphp
    <!-- BEGIN LOADER -->
    <!-- ... (your existing loader code) ... -->
    <!-- END LOADER -->
    <!-- BEGIN MAIN CONTAINER -->
    <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="search-overlay"></div>
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <form id="updateAppointmentForm">
                <div class="middle-content container-xxl">
                    <div class="row layout-top-spacing">
                        <div class="top-tabel">
                            <div class="title">
                                <h6 class="card-title pl-0">Doctor > Appointment Time</h6>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                            <div class="widget-content widget-content-area br-8 position-btn px-3 py-4">
                                <div id="zero-config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer department">
                                    <h2>Update Appointments</h2>
                                    <divider></divider>
                                    <div class="mb-3 col-md-6 p-0">
                                        <label class="form-label">Date</label>
                                        <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
                                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" disabled>
                                    </div>
                                    {{-- <!-- <button><a href="" class="download-btn w-100">Submit</a></button> --> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                            <div class="widget-content widget-content-area br-8 position-btn px-3 py-4">
                                <div id="zero-config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer department">
                                    <div class="mb-3 col-md-12 p-0">
                                        <label class="form-label">Choose Time</label>
                                        <div class="mb-3 col-md-12 p-0 m-0">
                                            <label class="form-label">Check/Uncheck All</label>
                                            <input type="checkbox" id="checkAll">
                                        </div>
                                        <div class="checkboxs">
                                            @php
                                                $startTime = \Carbon\Carbon::createFromTime(6, 0); // 6:00 AM
                                                $endTime = \Carbon\Carbon::createFromTime(22, 0); // 10:00 PM
                                                $breakStartTime = \Carbon\Carbon::createFromTime(12, 0); // 12:00 PM
                                                $breakEndTime = \Carbon\Carbon::createFromTime(14, 0); // 2:00 PM
                                                $timeGap = 30; // 30 minutes time gap
                                            @endphp

                                            @while ($startTime < $endTime)
                                                @php
                                                    $formattedTime = $startTime->format('H:i:s');
                                                    $isChecked = in_array($formattedTime, $selectedTimes); // Check if the time is already booked

                                                    // Skip the break time
                                                    if (!$startTime->between($breakStartTime, $breakEndTime)) {
                                                @endphp
                                                    <div class="chekbxsd">
                                                        <input type="checkbox" name="time_array[]" value="{{ $formattedTime }}" {{ $isChecked ? 'checked' : '' }} />
                                                        <label>{{ $startTime->format('g:i A') }}</label>
                                                    </div>
                                                @php
                                                    }
                                                    $startTime->addMinutes($timeGap);
                                                @endphp
                                            @endwhile
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                            <div class="widget-content widget-content-area br-8 position-btn px-3 py-4">
                                <div id="zero-config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer department">
                                    <div class="mb-3 col-md-12 p-0 m-0">
                                        <button><a class="download-btn w-100">Submit</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/doctor/js/appointment/update.js') }}"></script>
@endsection
