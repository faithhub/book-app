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
    @include('vendor.layouts.includes.style')
</head>

<body>
    <!-- <div id="loading">
        <div id="loading-center">
        </div>
    </div> -->
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        @include('vendor.layouts.includes.alert')
        <!-- Sidebar  -->
        @include('vendor.layouts.includes.sidebar')
        <!-- TOP Nav Bar -->
        @include('vendor.layouts.includes.navbar')
        <!-- TOP Nav Bar END -->
        <!-- Page Content  -->
        @yield('vendor')
    </div>
    <!-- Wrapper END -->
    <!-- Footer -->
    @include('vendor.layouts.includes.footer')
    <!-- color-customizer END -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @include('vendor.layouts.includes.script')
</body>

</html>