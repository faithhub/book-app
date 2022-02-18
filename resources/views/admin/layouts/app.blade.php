<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Virtual Law Library - {{ $title ?? '' }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logos/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logos/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('logos/favicon.png') }}">
    <!-- Favicon -->
    @include('admin.layouts.includes.style')
</head>

<body>
    <!-- <div id="loading">
        <div id="loading-center">
        </div>
    </div> -->
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        @include('admin.layouts.includes.alert')
        <!-- Sidebar  -->
        @include('admin.layouts.includes.sidebar')
        <!-- TOP Nav Bar -->
        @include('admin.layouts.includes.navbar')
        <!-- TOP Nav Bar END -->
        <!-- Page Content  -->
        @yield('admin')
    </div>
    <!-- Wrapper END -->
    <!-- Footer -->
    @include('admin.layouts.includes.footer')
    <!-- color-customizer END -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @include('admin.layouts.includes.script')
</body>

</html>