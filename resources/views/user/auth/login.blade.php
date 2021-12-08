<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Booksto - Responsive Bootstrap 4 Admin Dashboard Template</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> -->
    <!-- Typography CSS -->
    <!-- Style CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> -->
    <!-- Responsive CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"> -->
</head>
@include('user.layouts.includes.alert')
<style>
    .card {
        margin: 5rem;
        padding: 20px;
        border-radius: 30px;
        box-shadow: -2px 0px 14px 5px rgba(0, 0, 0, 0.52);
        -webkit-box-shadow: -2px 0px 14px 5px rgba(0, 0, 0, 0.52);
        -moz-box-shadow: -2px 0px 14px 5px rgba(0, 0, 0, 0.52);
    }
</style>

<body>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Sign in Start -->
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center" style="overflow: auto; margin: auto; position: absolute; top: 0; left: 0; bottom: 0; right: 0;">
            <div class="card col-md-4 offest-md-4">
                <div class="">
                    <form method="POST" action="{{ route('user.login') }}">
                        @csrf
                        <div class="text-center py-4">
                            <img class="img-fluid" src="{{ asset('logos/logo.png') }}" alt="Logo" style="max-width: 80px;">
                            <h2>Sign In</h2>
                        </div>
                        <div class="row g-2 mb-4">
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" id="floatingInputGridFullUsername">
                                    <label for="floatingInputGridFullUsername">Username</label>
                                    @error('username')
                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row g-2 mb-4">
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" id="floatingInputGridFullpassword">
                                    <label for="floatingInputGridFullpassword">Password</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 text-right">
                            <button class="btn btn-success" type="submit">Login</button>
                        </div>
                        <div class="text-center">
                            <p>Didn't have an account? <a href="{{ route('user.register') }}" class="">Register here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script> -->
</body>

</html>