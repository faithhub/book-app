<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Virtual Law Library - User Sign Up</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logos/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logos/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('logos/favicon.png') }}">
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
            <div class="card col-md-8 offest-md-2">
                <div class="">
                    <form method="POST" action="{{ route('user.register') }}">
                        @csrf
                        <div class="text-center py-4">
                            <img class="img-fluid" src="{{ asset('logos/logo.png') }}" alt="Logo" style="max-width: 80px;">
                            <h2>Sign Up</h2>
                        </div>
                        <div class="row g-2 mb-4">
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="floatingInputGridFullName">
                                    <label for="floatingInputGridFullName">Full Name</label>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
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
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="floatingInputGridFullemail">
                                    <label for="floatingInputGridFullemail">Email</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="mobile" value="{{ old('mobile') }}" id="floatingInputGridFullmobile">
                                    <label for="floatingInputGridFullmobile">Mobile Number</label>
                                    @error('mobile')
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
                                    <select class="form-select" name="gender" id="floatingSelectGridGender" aria-label="Floating label select example">
                                        <option selected value="">Select Gender</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? "selected" : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? "selected" : '' }}>Female</option>
                                    </select>
                                    <label for="floatingSelectGridGender">Gender</label>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="date" class="form-control" name="dob" value="{{ old('dob') }}" id="floatingInputGridFulldob">
                                    <label for="floatingInputGridFulldob">Date of Birth</label>
                                    @error('dob')
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
                                    <input type="password" class="form-control" name="password" id="floatingInputGridFullpassword">
                                    <label for="floatingInputGridFullpassword">Password</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="password_confirmation"  id="floatingInputGridFullpassword_confirmation">
                                    <label for="floatingInputGridFullpassword_confirmation">Confirm Password</label>
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 text-right">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                        <div class="text-center">
                            <p>Already have an account? <a href="{{ route('user.login') }}" class="">Login here</a></p>
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