@include('admin.header')
@if (!isset($showSidebar) || $showSidebar !== false)
    @include('admin.sidebar')
@endif
@include('admin.common-modal')
@yield('content')
@include('admin.footer')
@yield('scripts')
