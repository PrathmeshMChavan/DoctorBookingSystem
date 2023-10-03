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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/website/src/plugins/src/table/datatable/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.css" />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.print.min.css' rel='stylesheet'
        media='print' />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css"
        integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <section class="navigation">
        <div class="nav-container">
            <div class="brand">
                <a href="#!">DoctorBooking</a>
            </div>
            <nav>
                <div class="nav-mobile"><a id="navbar-toggle" href="#!"><span></span></a></div>
                <ul class="nav-list">
                    @if (auth()->check())
                        <li>
                            <a href="{{ route('booked.slot') }}">My Appointments</a>
                        </li>
                        <li>
                            <a href="{{ route('patient.profile') }}">Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}">Logout</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login.index') }}">Login</a>
                        </li>
                        <li>
                            <a href="{{ route('registerForm') }}">Register</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </section>
    <section class="section1">
        <div class="row container m-auto">
            <div class="col-md-6">
                <img src="{{ asset('assets/website/image/image1.jpg') }}" />
            </div>
            <div class="col-md-6 content">
                @if (auth()->check())
                    <h3>Book your appointment</h3>
                @else
                    <h3>Create an account & Book your appointment</h3>
                @endif
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat</p>
                @if (!auth()->check())
                    <div class="sec1-btn">
                        <button><a class="register" href="{{ route('registerForm') }}">Register as Patient</a></button>
                        <button><a class="login" href="{{ route('login.index') }}">Login</a></button>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <section class="sectio2">
        <div class="find-doctor">
            <div class="container" id="main">
                <h2>Find Doctors</h2>
                <div class="calender">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="sectio3">
        <div class="doctors">
            <div class="container" id="DoctorTableData">
                @include('website.doctor_table')
            </div>
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
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/website/js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/website/js/appointments/script.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"
    integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.appointment', function(e) {
            e.preventDefault();

            @if (auth()->check() && auth()->user()->role == 'patient')
            @else
                toastr.error('You must be logged in as a patient to book an appointment.',
                    'Login Required');
            @endif
        });
    });
</script>
<script>
    @if (session()->has('error'))
        toastr.error("{{ session('error') }}", "Error");
    @endif
</script>

</html>
