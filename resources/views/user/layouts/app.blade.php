<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Booksto - Responsive Bootstrap 4 Admin Dashboard Template</title>
    <!-- Favicon -->
    @include('user.layouts.includes.style')
</head>

<body>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
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