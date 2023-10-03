@extends('doctor.layouts.master')
@section('content')
    @php
        $currentPage = 'dashboard';
    @endphp
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
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
                                    <h6 class="card-title">Dashboard</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-six">
                                <div class="widget-heading">
                                    <div class="task-action">
                                        <div class="row w-100">
                                            <div class="col-md-3 col-sm-12 layout-spacing pb-0 mb-5">
                                                <div data-draggable="true"
                                                    class="card simple-title-task ui-sortable-handle">
                                                    <div class="card-body">
                                                        <div class="task-header">
                                                            <div class="order-summary">
                                                                <div class="summary-list">
                                                                    <div class="w-summary-details">
                                                                        <div class="w-summary-info">
                                                                            <div class="content">
                                                                                <h3>Patients</h3>
                                                                                <h2>10</h2>
                                                                            </div>
                                                                            <i class="fa fa-users" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="w-summary-stats">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-success" role="progressbar"
                                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-12 layout-spacing pb-0 mb-5">
                                                <div data-draggable="true"
                                                    class="card simple-title-task ui-sortable-handle">
                                                    <div class="card-body">
                                                        <div class="task-header">
                                                            <div class="order-summary">
                                                                <div class="summary-list">
                                                                    <div class="w-summary-details">
                                                                        <div class="w-summary-info">
                                                                            <div class="content">
                                                                                <h3>Booking</h3>
                                                                                <h2>11</h2>
                                                                            </div>
                                                                            <i class="fa fa-comment-o"
                                                                                aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="w-summary-stats">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-success" role="progressbar"
                                                                style="width: 40%" aria-valuenow="40" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
