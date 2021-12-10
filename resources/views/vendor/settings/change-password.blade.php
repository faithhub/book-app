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
                                        <h4 class="card-title">Change Password</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <form method="POST" action="{{ route('vendor.change.password') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cpass">Current Password:</label>
                                            <!-- <a href="javascripe:void();" class="float-right">Forgot Password</a> -->
                                            <input type="Password" class="form-control" id="cpass" name="old_password">
                                            @error('old_password')
                                                <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="npass">New Password:</label>
                                            <input type="Password" class="form-control" id="npass" name="new_password">
                                            @error('new_password')
                                                <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="vpass">Verify Password:</label>
                                            <input type="Password" class="form-control" id="vpass" name="confirm_new_password">                                            
                                            @error('confirm_new_password')
                                                <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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