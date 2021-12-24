@extends('admin.layouts.app')
@section('admin')
<!-- Page Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-edit-list-data">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Personal Information</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <form action="{{ route('admin.profile') }}" method="POST">
                                        @csrf
                                        <div class="row align-items-center">
                                            <div class="form-group col-sm-6">
                                                <label for="fname">Username:</label>
                                                <input type="text" class="form-control" id="fname" value="{{ Auth::guard('admin')->user()->username }}" readonly>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="lname">Email Address:</label>
                                                <input type="text" class="form-control" id="lname" value="{{ Auth::guard('admin')->user()->email }}" disabled>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="uname">Full Name:</label>
                                                <input type="text" class="form-control" name="name" id="uname" value="{{ Auth::guard('admin')->user()->name }}">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="cname">Phone Number:</label>
                                                <input type="text" class="form-control" name="mobile" id="cname" value="{{ Auth::guard('admin')->user()->mobile }}">
                                                @error('mobile')
                                                <span class="invalid-feedback" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>Gender:</label>
                                                <select class="form-control" name="gender" id="exampleFormControlSelect1">
                                                    <option value="Male" {{ Auth::guard('admin')->user()->gender == "Male" ? "selected" : '' }}>Male</option>
                                                    <option value="Female" {{ Auth::guard('admin')->user()->gender == "Female" ? "selected" : '' }}>Female</option>
                                                </select>
                                                @error('gender')
                                                <span class="invalid-feedback" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="dob">Date Of Birth:</label>
                                                <input class="form-control" id="dob" type="date" name="dob" value="{{ Auth::guard('admin')->user()->dob }}">
                                                @error('dob')
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
        </div>
    </div>
</div>
@endsection