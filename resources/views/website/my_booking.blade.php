<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>DoctorBooking</title>
    <!-- <link rel="icon" type="image/x-icon" href="../src/assets/img/logo.png" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('assets/website/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/website/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css"
        integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <section class="navigation">
        <div class="nav-container">
            <div class="brand">
                <a href="{{ route('index') }}">DoctorBooking</a>
            </div>
            <nav>
                <div class="nav-mobile"><a id="navbar-toggle" href="#!"><span></span></a></div>
                <ul class="nav-list">
                    <li>
                        <a href="{{ route('booked.slot') }}">My Appointments</a>
                    </li>
                    <li>
                        <a href="{{ route('patient.profile') }}">Profile</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}">Logout</a>
                    </li>

                </ul>
            </nav>
        </div>
    </section>
    <section class="Logins">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="filter_date">Filter by Date:</label>
                    <input type="date" id="filter_date" class="form-control">
                </div>
            </div>
            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                <thead class="text-center">
                    <tr>
                        <th class="text-center">Sr.no</th>
                        <th>Doctor</th>
                        <th>Time</th>
                        <th>Date For</th>
                        <th>Created Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($bookedAppointments as $bookedAppointment)
                        <tr>
                            <td class="">{{ $loop->iteration }}</td>
                            <td class="">{{ $bookedAppointment->appointment->doctor->full_name }}</td>
                            <td>{{ date('g:i a', strtotime($bookedAppointment->appointment->time)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($bookedAppointment->appointment->date)) }}</td>
                            <td>{{ $bookedAppointment->created_at }}</td>
                            <td>
                                @if ($bookedAppointment->status == 'pending')
                                    Pending for Approval
                                @else
                                    {{ $bookedAppointment->status }}
                                @endif
                                @if (
                                    $bookedAppointment->status != 'cancel' &&
                                        $bookedAppointment->status != 'reject' &&
                                        $bookedAppointment->status != 'postpone')
                                    <select name="status" data-id="{{ $bookedAppointment->id }}" class="updateStatus">
                                        <option selected disabled>Cancel/Reject/Postpone</option>
                                        <option value="cancel">Cancel</option>
                                        <option value="reject">Reject</option>
                                        <option value="postpone">Postpone</option>
                                    </select>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </section>

</body>
<footer>
    <div class="footer-wrapper">
        <div class="footer-section f-section-1">
            <p class="">Copyright © <span class="dynamic-year">2022</span>All rights reserved.</p>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('assets/website/src/plugins/src/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('assets/website/js/appointments/booking_status.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"
    integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var dataTable = $('#zero-config').DataTable({
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
        "pageLength": 10,
    });
    $(document).ready(function() {
        var date_input = $('#filter_date');

        date_input.on('change', function() {
            var selected_date = this.value;
            if (selected_date) {
                var converted_date = selected_date.split('-').reverse().join('/');
                dataTable.column(3).search(converted_date).draw();
            } else {
                dataTable.column(3).search('').draw();
            }
        });
    });
</script>

</html>
