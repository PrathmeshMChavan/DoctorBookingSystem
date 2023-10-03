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
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        <div class="row container m-auto">
            {{-- <div class="col-md-4">
                <div class="doctor_details">
                    <h2>Doctor Information</h2>
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="background-image: url('http://i.pravatar.cc/500?img=7');">
                                </div>
                            </div>
                        </div>
                    <p><span>Name:</span> John Doe</p>
                    <p><span>Degree:</span>MBBS</p>
                    <p><span>Specialist</span> Cardiologist</p>
                    </div>
                </div> --}}

            <div class="col-md-8">
                <form id="profileForm">
                    <div class="profile-form">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" name="name" value="{{ $user->full_name }}" type="text">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input class="form-control" name="address" value="{{ $user->address }}" type="text">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input class="form-control" name="phone_number" value="{{ $user->phone_number }}" type="tel">
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" id="" class="form-control form-select">
                                <option disabled selected>Select Gender</option>
                                <option {{ $user->gender == 'male' ? 'selected' : '' }} value="male">Male</option>
                                <option {{ $user->gender == 'female' ? 'selected' : '' }} value="female">Female
                                </option>
                                <option {{ $user->gender == 'other' ? 'selected' : '' }} value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Bio</label>
                            <textarea name="about" class="form-control">{{ $user->about }}  </textarea>
                        </div>
                        <button><a class="register mt-4">Submit</a></button>
                    </div>
                </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('assets/website/js/profile.js') }}"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
</script>

</html>
