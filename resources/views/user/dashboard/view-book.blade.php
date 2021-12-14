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
            <div class="col-lg-8">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Book Details</h4>
                    </div>
                    <div class="iq-card-body pb-0">
                        <div class="description-contens align-items-top row">
                            <div class="col-md-6">
                                <div class="iq-card-transparent iq-card-block iq-card-stretch iq-card-height">
                                    <div class="iq-card-body p-0">
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                @if($book->book_cover_type == "Book Cover")
                                                <img src='{{ asset("BOOKCOVER/$book->book_cover") }}' class="img-fluid w-100 rounded" alt="">
                                                @elseif($book->book_cover_type == "Video Cover")
                                                <!-- <div class="embed-responsive embed-responsive-1by1">
                                                    <iframe class="embed-responsive-item" src='{{ asset("VIDEOCOVER/$book->video_cover") }}' allowfullscreen></iframe>
                                                </div> -->
                                                <video class="embed-responsive embed-responsive-1by1" loop controls muted>
                                                    <source src="{{ asset('VIDEOCOVER/'.$book->video_cover) }}" type="video/mp4" />
                                                </video>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="iq-card-transparent iq-card-block iq-card-stretch iq-card-height">
                                    <div class="iq-card-body p-0">
                                        <h3 class="mb-3">{{$book->book_name}}</h3>
                                        <div class="price d-flex align-items-center font-weight-500 mb-2">
                                            <!-- <span class="font-size-20 pr-2 old-price">$99</span> -->
                                            @if($book->book_paid_free == "Paid")
                                            <span class="font-size-24 text-dark"><b style="color: green;">₦{{number_format($book->book_price, 2)}}</b></span>
                                            @elseif($book->book_paid_free == "Free")
                                            <span class="font-size-24 text-dark"><b style="color: green;">Free</b></span>
                                            @endif
                                        </div>
                                        <div class="mb-3 d-block">
                                            <span class="font-size-20 text-warning">
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                        </div>
                                        <span class="text-dark mb-4 pb-4 iq-border-bottom d-block">{{$book->book_desc}}</span>
                                        <div class="text-primary mb-1">Author: <span class="text-body text-me">{{$book->book_author}}</span></div>
                                        <div class="text-primary mb-1">Category: <span class="text-body text-me">{{$book->category->name}}</span></div>
                                        <div class="text-primary mb-1">Material Type: <span class="text-body text-me">{{$book->material->name}}</span></div>
                                        <div class="text-primary mb-1">Tag: <span class="text-body text-me">{{$book->book_tag}}</span></div>
                                        <div class="text-primary mb-1">Year of Publish: <span class="text-body text-me blder">{{$book->book_year}}</span></div>
                                        <div class="text-primary mb-1">Country of Publish: <span class="text-body text-me">{{$book->country->country_label}}</span></div>


                                        @if($book->book_paid_free == "Paid")
                                        <div class="mb-4 mt-3 d-flex align-items-center">
                                            <a href='' onclick="return confirm('Are you sure you want to Buy this material?')" class="btn btn-primary view-more mr-2">Buy Book</a>
                                            <a href='' onclick="return confirm('Are you sure you want to Rent this material?')" class="btn btn-primary view-more mr-2">Rent Book</a>
                                        </div>
                                        @else
                                        <div class="mb-4 mt-3 d-flex align-items-center">
                                            <a  onclick="return confirm('Are you sure you want to access this Book?')" href='{{ url("user/access-book/$book->book_name/$book->id") }}' class="btn btn-primary view-more mr-2">Access Book</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Search Book</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <form method="POST" action="{{ route('user.search') }}">
                            @csrf
                            <div class="form-group col-sm-12">
                                <label for="cpass"><b>Title of Material:</b></label>
                                <input type="text" class="form-control" id="cpass" value="{{old('book_name')}}" name="book_name">
                                @error('book_name')
                                <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- <div class="form-group col-sm-12">
                                <label for="cpass"><b>Name of Author:</b></label>
                                <input type="text" class="form-control" id="cpass" value="{{old('book_author')}}" name="book_author">
                                @error('book_author')
                                <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="cpassk"><b>Category</b></label>
                                <select class="form-control" id="cpassk" name="book_cat" id="exampleFormControlSelect1">
                                    <option value="">Select a Category</option>
                                    @if(isset($book_cats))
                                    @foreach($book_cats as $cats)
                                    <option value="{{$cats->id}}" {{ old('book_cat') == $cats->id ? "selected" : '' }}>{{$cats->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('book_cat')
                                <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="cpassk"><b>Type of Material</b></label>
                                <select class="form-control" id="materialTypeID" name="book_material_type" id="exampleFormControlSelect1">
                                    <option value="">Select a Type</option>
                                    @if(isset($materials))
                                    @foreach($materials as $cats)
                                    <option value="{{$cats->id}}" {{ old('book_material_type') == $cats->id ? "selected" : '' }}>{{$cats->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('book_material_type')
                                <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="cpassk"><b>Paid/Free</b></label>
                                <select class="form-control" id="bookPriceID" onchange="bookPrice(this.value)" name="book_paid_free" id="exampleFormControlSelect1">
                                    <option value="">Choose One</option>
                                    <option value="Paid" {{ old('book_paid_free') == 'Paid' ? "selected" : '' }}>Paid</option>
                                    <option value="Free" {{ old('book_paid_free') == 'Free' ? "selected" : '' }}>Free</option>
                                </select>
                                @error('book_paid_free')
                                <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div> -->
                            <button type="submit" class="btn btn-primary btn-block d-block mt-3">Search</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection