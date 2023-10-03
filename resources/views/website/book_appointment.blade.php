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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
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
    <section class="Logins">
        <div class="row container m-auto">
            <div class="col-md-4">
                <div class="doctor_details">
                    <h2>Doctor Information</h2>
                    <img src="{{ asset('assets/website/image/doctor-profile-small.png') }}" class="profile-icon" />
                    <p><span>Name:</span> {{ $doctor->full_name }}</p>
                    <p><span>Degree:</span>MBBS</p>
                    <p><span>Specialist</span> Cardiologist</p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="appointment_time">
                    <h3 class="date">{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}                    </h3>
                    <div class="time">
                        @foreach ($availableTimeSlots as $id => $time)
                        <a class="time-btn" href="" data-patient_id="{{ auth()->user()->id }}" data-slot_id="{{ $id }}">{{ date('g:i A', strtotime($time)) }}</a>
                        @endforeach
                    </div>
                </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="{{ asset('assets/website/js/appointments/script.js') }}"></script>
</html>
