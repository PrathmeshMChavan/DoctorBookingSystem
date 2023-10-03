@extends('admin.layouts.master')
@section('content')
    @php
        $showSidebar = false;
    @endphp
    @php
        $currentPage = 'login';
    @endphp
<div id="load_screen">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div>
    </div>
</div>
<!--  END LOADER -->

<div class="auth-container d-flex signup">

    <div class="container mx-auto align-self-center">

        <div class="row">


            <div
                class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form id="loginForm">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h2 class="text-center">Login</h2>
                                <p class="text-center">Sign in into your account to start</p>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 chekbx">
                                    {{-- <div class="form-check form-check-primary form-check-inline">
                                        <input class="form-check-input me-3" type="checkbox" id="form-check-default">
                                        <label class="form-check-label" for="form-check-default">
                                            Keep me signed in
                                        </label>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 fgtps">
                                    {{-- <a href="forgot-password.php">Forgot Password?</a> --}}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-4">
                                    <button><a
                                            class="download-btn w-100">Login</a></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/admin/js/sign_in.js') }}"></script>
    <script>
        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>
@endsection
