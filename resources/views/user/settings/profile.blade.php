@extends('user.layouts.app')
@section('user')
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
                                    <form>
                                        <div class=" row align-items-center">
                                            <div class="form-group col-sm-6">
                                                <label for="fname">Username:</label>
                                                <input type="text" class="form-control" id="fname" value="" readonly>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="lname">Email Address:</label>
                                                <input type="text" class="form-control" id="lname" value="" disabled>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="uname">Full Name:</label>
                                                <input type="text" class="form-control" id="uname" value="Barry@01">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="cname">Phone Number:</label>
                                                <input type="text" class="form-control" id="cname" value="Atlanta">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>Gender:</label>
                                                <select class="form-control" id="exampleFormControlSelect1">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="dob">Date Of Birth:</label>
                                                <input class="form-control" id="dob" type="date" value="1984-01-24">
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