@extends('user.layouts.app')
@section('user')
<style>
    .text-me {
        color: #6c757d;
        font-weight: 600;
    }
</style>
<!-- Page Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Add New Group Member</h4>
                        <div class="text-right">
                            <a href="{{ route('user.group') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                    <div class="iq-card-body">

                        <form action="{{ route('user.create.group.member') }}" method="POST">
                            @csrf
                            <div class=" row align-items-center">
                                <div class="form-group col-sm-6">
                                    <label for="fname">Username:</label>
                                    <input type="text" class="form-control" name="username" id="fname" value="{{ old('username') }}">
                                    @error('username')
                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="lname">Email Address:</label>
                                    <input type="text" class="form-control" name="email" id="lname" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="uname">Full Name:</label>
                                    <input type="text" class="form-control" name="name" id="uname" value="{{ old('name') }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="mobile">Phone Number:</label>
                                    <input type="number" class="form-control" name="mobile" id="mobile" value="{{ old('mobile') }}">
                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Gender:</label>
                                    <select class="form-control" name="gender" id="exampleFormControlSelect1">
                                        <option value="Male" {{ old('gender') == "Male" ? "selected" : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == "Female" ? "selected" : '' }}>Female</option>
                                    </select>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="dob">Date Of Birth:</label>
                                    <input class="form-control" id="dob" type="date" name="dob" value="{{ old('dob') }}">
                                    @error('dob')
                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="cname">Password:</label>
                                    <input type="password" class="form-control" name="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="password_confirmation">Confirm Password:</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn iq-bg-danger">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection