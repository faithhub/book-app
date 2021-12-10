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
                                        <h4 class="card-title">Upload New Book</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <form method="POST" action="{{ route('vendor.change.password') }}">
                                        @csrf

                                        <div class="row align-items-center">
                                            <div class="form-group col-sm-12">
                                                <label for="cpassk">Book Category:</label>
                                                <select class="form-control" id="cpassk" name="book_cat" id="exampleFormControlSelect1">
                                                    <option value="Male" {{ Auth::guard('vendor')->user()->gender == "Male" ? "selected" : '' }}>Male</option>
                                                    <option value="Female" {{ Auth::guard('vendor')->user()->gender == "Female" ? "selected" : '' }}>Female</option>
                                                </select>
                                                @error('book_cat')
                                                <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="cpass">Book Name:</label>
                                                <input type="text" class="form-control" id="cpass" name="book_name" placeholder="Dakota Krout">
                                                @error('book_name')
                                                <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="cpass">Book Price:</label>
                                                <input type="number" class="form-control" id="cpass" name="book_price" placeholder="$48">
                                                @error('book_price')
                                                <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="cpass">Book Rent Per Day:</label>
                                                <input type="number" class="form-control" id="cpass" name="book_rent" placeholder="$2">
                                                @error('book_rent')
                                                <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="cpass">Book Author:</label>
                                                <input type="text" class="form-control" id="cpass" name="book_author" placeholder="Jhone Steben">
                                                @error('book_author')
                                                <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="npass">Book Description:</label>
                                                <textarea name="book_desc" id="npass" class="form-control" placeholder="Monterhing in the best book testem ipsum is simply dtest in find in a of the printing and typeseting industry into to end.in find in a of the printing and typeseting industry in find to make it all done into end."></textarea>
                                                @error('book_desc')
                                                <span class="invalid-feedback mb-2" role="alert" style="display: block">
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