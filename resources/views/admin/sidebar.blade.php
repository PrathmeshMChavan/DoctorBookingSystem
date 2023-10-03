<style>
    /* scrollbar */
    /* width */
    ::-webkit-scrollbar {
        width: 7px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px transparent;
        border-radius: 4px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #c8ecc2;
        border-radius: 4px;
    }

    /* scrollbar */
    .shrink .dropdown-container li {
        display: none;
    }

    .sidebar-links {
        height: 100%;
        overflow-y: auto;
        padding-right: 5px;
    }

    .logo2 {
        display: none;
    }

    .shrink .logo2 {
        display: block;
        width: 40px;
    }

    .shrink .logo {
        display: none;
    }

    .sidebar-top .logo {
        width: 45%;
        margin: 0;
    }

    .shrink button.dropdown-btn span.text-1,
    .shrink button.dropdown-btn i {
        display: none;
        transition: 8s ease-in-out;
        padding-left: 20px;
    }

    .shrink button.dropdown-btn {
        justify-content: center;
        padding-right: 0;
    }

    .dropdown-container {
        display: none;
    }

    .dropdown-container li {
        padding-left: 65px;
        position: relative;
    }

    .dropdown-container li::before {
        position: absolute;
        top: 45%;
        left: 21%;
        width: 5px;
        height: 5px;
        background: #000;
        content: '';
        border-radius: 50%;
    }

    button.dropdown-btn:hover img {
        filter: invert(100%);
    }

    button.dropdown-btn.active i.fa.fa-angle-down {
        transform: rotate(180deg);
        transition: .3s;
    }

    button.dropdown-btn i.fa.fa-angle-down {
        transition: .3s;
    }

    button.dropdown-btn.active {
        margin-bottom: 10px;
    }

    .sidebar-links li.drop_li a {
        height: 35px;
    }

    .sidebar-links li.drop_li.active a {
        color: #fff;
    }

    .sidebar-links li.drop_li.active::before {
        background: #fff;
    }

    button.dropdown-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 10px 10px 0;
        border: 0;
        background: 0;
        font-size: 15px;
        width: 100%;
        margin-bottom: 10px;
        cursor: pointer;
    }

    button.dropdown-btn:hover {
        background: #0e5f02;
        border-radius: 10px;
        color: #fff;
    }

    .dropdown-container:hover li {
        color: #fff;
    }

    button.dropdown-btn span.text-1 {
        padding-left: 0px;
        padding-top: 4px;
    }

    .sidebar-links li:hover a {
        color: #fff;
    }

    .sidebar-links li:hover:before {
        background: #fff;
    }
</style>
<div class="header-container container-xxl">
    <header class="header navbar navbar-expand-sm expand-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown user">
                        <a class="nav-link dropdown-toggle " href="#" id="userProfileDropdown" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <div class="avatar-container">
                                <div class="avatar avatar-sm avatar-indicators avatar-online">
                                    <img alt="avatar" src="{{ asset('assets/admin/src/assets/img/profile-30.png') }}"
                                        class="rounded-circle">
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown"
                            data-bs-popper="none">
                            <div class="dropdown-item">
                                <a href="signup.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span>Log Out</span>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</div>
<!-- sidebar -->
<nav>
    <div class="sidebar-top">
        <span class="shrink-btn">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
        </span>
        <img src="{{ asset('assets/admin/src/assets/img/logo.png') }}" class="logo')}}" alt="">
        {{-- <img src="{{ asset('assets/admin/src/assets/img/logo.png')}}" class="logo2')}}" alt=""> --}}
        <!-- <h3 class="hide">FarmFeed</h3> -->
    </div>
    <div class="sidebar-links">
        <ul>
            <div class="active-tab"></div>
            <li class="tooltip-element <?php
            if ($currentPage == 'dashboard') {
                echo 'active';
            }
            ?>" data-tooltip="0">
                <a href="{{ route('doctor.index') }}" data-active="0">
                    <div class="icons">
                        <img src="{{ asset('assets/admin/src/assets/img/dashboard-icon-vector-2.jpg') }}" />
                        <span class="text">Dashboard</span>
                    </div>
                </a>
            </li>
            <button class="dropdown-btn ">
                <div class="icons">
                    <img src="{{ asset('assets/admin/src/assets/img/users-svgrepo-com.svg') }}" />
                    <span class="text-1">Department</span>
                </div>
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </button>
            <div class="dropdown-container">
                <ul>
                    <li class="drop_li tooltip-element <?php
                    if ($currentPage == 'department_create') {
                        echo 'active';
                    }
                    ?>"><a
                            href="{{ route('department.create') }}">Create</a></li>
                    <li class="drop_li <?php
                    if ($currentPage == 'department_view') {
                        echo 'active';
                    }
                    ?>"><a href="{{ route('department.index') }}">View</a></li>
                </ul>
            </div>
            <button class="dropdown-btn">
                <div class="icons">
                    <img src="{{ asset('assets/admin/src/assets/img/users-svgrepo-com.svg') }}" />
                    <span class="text-1">Doctor</span>
                </div>
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </button>
            <div class="dropdown-container">
                <ul>
                    <li class="drop_li tooltip-element <?php
                    if ($currentPage == 'doctor_create') {
                        echo 'active';
                    }
                    ?>"><a
                            href="{{ route('doctor.create') }}">Create</a></li>
                    <li class="drop_li <?php
                    if ($currentPage == 'doctor_view') {
                        echo 'active';
                    }
                    ?>"><a href="{{ route('doctor.index') }}">View</a></li>
                </ul>
            </div>
            <button class="dropdown-btn">
                <div class="icons">
                    <img src="{{ asset('assets/admin/src/assets/img/users-svgrepo-com.svg') }}" />
                    <span class="text-1">Patient Appointmentt</span>
                </div>
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </button>
            <div class="dropdown-container">
                <ul>
                    <li class="drop_li tooltip-element <?php
                    if ($currentPage == 'co-op') {
                        echo 'active';
                    }
                    ?>"><a
                            href="{{ route('appointment.today') }}">Today's Appointment</a></li>
                    <li class="drop_li <?php
                    if ($currentPage == 'farmer') {
                        echo 'active';
                    }
                    ?>"><a href="{{ route('appointment.all') }}">All Time
                            Appointment</a></li>
                </ul>
            </div>
        </ul>
    </div>
</nav>
<script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>
