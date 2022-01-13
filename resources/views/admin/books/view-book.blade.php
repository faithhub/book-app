@extends('admin.layouts.app')
@section('admin')
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
            <div class="col-lg-8 offset-lg-2">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Materials Description</h4>
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
                                                <video class="embed-responsive embed-responsive-1by1" loop controls muted>
                                                    <source src="{{ asset('VIDEOCOVER/'.$book->video_cover) }}" type="video/mp4" />
                                                </video>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- {{$book}} -->
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
                                                @if(isset($book->rate))
                                                @if($book->rate->rate == 1)
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star mr-1" style="color: gray;"></i>
                                                <i class="fa fa-star mr-1" style="color: gray;"></i>
                                                <i class="fa fa-star mr-1" style="color: gray;"></i>
                                                <i class="fa fa-star mr-1" style="color: gray;"></i>
                                                @elseif($book->rate->rate == 2)
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star mr-1" style="color: gray;"></i>
                                                <i class="fa fa-star mr-1" style="color: gray;"></i>
                                                <i class="fa fa-star mr-1" style="color: gray;"></i>
                                                @elseif($book->rate->rate == 3)
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star mr-1" style="color: gray;"></i>
                                                <i class="fa fa-star mr-1" style="color: gray;"></i>
                                                @elseif($book->rate->rate == 4)
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star mr-1" style="color: gray;"></i>
                                                @elseif($book->rate->rate == 5)
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                <i class="fa fa-star mr-1"></i>
                                                @endif
                                                @else
                                                <i class="fa fa-star mr-1" style="color: gray;"></i>
                                                <i class="fa fa-star mr-1" style="color: gray;"></i>
                                                <i class="fa fa-star mr-1" style="color: gray;"></i>
                                                <i class="fa fa-star mr-1" style="color: gray;"></i>
                                                <i class="fa fa-star mr-1" style="color: gray;"></i>
                                                @endif
                                            </span>
                                        </div>
                                        <span class="text-dark mb-4 pb-4 iq-border-bottom d-block">{{$book->book_desc}}</span>
                                        <div class="text-primary mb-1">Author: <span class="text-body text-me">{{$book->book_author}}</span></div>
                                        <div class="text-primary mb-1">Category: <span class="text-body text-me">{{$book->category->name}}</span></div>
                                        <div class="text-primary mb-1">Material Type: <span class="text-body text-me">{{$book->material->name}}</span></div>
                                        <div class="text-primary mb-1">Tag: <span class="text-body text-me">{{$book->book_tag}}</span></div>
                                        <div class="text-primary mb-1">Year of Publish: <span class="text-body text-me blder">{{$book->book_year}}</span></div>
                                        <div class="text-primary mb-1">Country of Publish: <span class="text-body text-me">{{$book->country->country_label}}</span></div>
                                        <div class="mb-2 d-flex align-items-center mt-2">
                                            <div class="text-primary mb-1 p-2">Total number of sold: <span class="text-body text-me">{{$book->sold}}</span></div>
                                            <div class="text-primary mb-1 p-2">Total number of Rent: <span class="text-body text-me">{{$book->rent}}</span></div>
                                        </div>

                                        <div class="mb-4 mt-3 d-flex align-items-center">
                                            <a onclick="return confirm('Are you sure you want to access this Material?')" href='{{ url("admin/access-material/$book->book_name/$book->id") }}' class="btn btn-primary view-more mr-2">Access Book</a>
                                            <a onclick="return confirm('Are you sure you want to delete this Material?')" href='{{ url("admin/delete-material/$book->id") }}' class="btn btn-danger view-more mr-2">Delete Book</a>
                                        </div>
                                    </div>
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