@include('doctor.header')
@if (!isset($showSidebar) || $showSidebar !== false)
    @include('doctor.sidebar')
@endif
@include('doctor.common-modal')
@yield('content')
@include('doctor.footer')
@yield('scripts')
