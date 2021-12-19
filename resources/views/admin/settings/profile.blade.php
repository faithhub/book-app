@extends('vendor.layouts.app')
@section('vendor')
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
                                    <form action="{{ route('vendor.profile') }}" method="POST">
                                        @csrf
                                        <div class="row align-items-center">
                                            <div class="form-group col-sm-6">
                                                <label for="fname">Username:</label>
                                                <input type="text" class="form-control" id="fname" value="{{ Auth::guard('vendor')->user()->username }}" readonly>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="lname">Email Address:</label>
                                                <input type="text" class="form-control" id="lname" value="{{ Auth::guard('vendor')->user()->email }}" disabled>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="uname">Full Name:</label>
                                                <input type="text" class="form-control" name="name" id="uname" value="{{ Auth::guard('vendor')->user()->name }}">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="cname">Phone Number:</label>
                                                <input type="text" class="form-control" name="mobile" id="cname" value="{{ Auth::guard('vendor')->user()->mobile }}">
                                                @error('mobile')
                                                <span class="invalid-feedback" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>Gender:</label>
                                                <select class="form-control" name="gender" id="exampleFormControlSelect1">
                                                    <option value="Male" {{ Auth::guard('vendor')->user()->gender == "Male" ? "selected" : '' }}>Male</option>
                                                    <option value="Female" {{ Auth::guard('vendor')->user()->gender == "Female" ? "selected" : '' }}>Female</option>
                                                </select>
                                                @error('gender')
                                                <span class="invalid-feedback" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="dob">Date Of Birth:</label>
                                                <input class="form-control" id="dob" type="date" name="dob" value="{{ Auth::guard('vendor')->user()->dob }}">
                                                @error('dob')
                                                <span class="invalid-feedback" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>                                            
                                            <div class="form-group col-sm-4">
                                                <label for="cname">Bank:</label>
                                                <input type="text" class="form-control" name="bank" id="cname" value="{{ Auth::guard('vendor')->user()->bank }}">
                                                @error('bank')
                                                <span class="invalid-feedback" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label for="cname">Account Number:</label>
                                                <input type="number" class="form-control" name="acc_number" id="cname" value="{{ Auth::guard('vendor')->user()->acc_number }}">
                                                @error('acc_number')
                                                <span class="invalid-feedback" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label for="cname">Account Name:</label>
                                                <input type="text" class="form-control" name="acc_name" id="cname" value="{{ Auth::guard('vendor')->user()->acc_name }}">
                                                @error('acc_name')
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