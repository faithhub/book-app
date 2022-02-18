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
    @include('user.layouts.includes.style')
</head>

<body>
    <!-- <div id="loading">
        <div id="loading-center">
        </div>
    </div> -->
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        @include('user.layouts.includes.alert')
        <!-- Sidebar  -->
        @include('user.layouts.includes.sidebar')
        <!-- TOP Nav Bar -->
        @include('user.layouts.includes.navbar')
        <!-- TOP Nav Bar END -->
        <!-- Page Content  -->
        @yield('user')
    </div>
    <!-- Wrapper END -->
    <!-- Footer -->
    @include('user.layouts.includes.footer')
    <!-- color-customizer END -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @include('user.layouts.includes.script')
</body>

</html>