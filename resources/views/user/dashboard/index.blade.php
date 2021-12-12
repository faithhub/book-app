@extends('user.layouts.app')
@section('user')
<div id="content-page" class="content-page">
    @if(isset($books))
    @foreach($mats as $value)
    <?php
    $articles = \App\Models\Book::where('book_material_type', $value->id)->take(4)->get();
    ?>
    
    @if($articles->count() > 0)
    <div class="col-lg-12">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div class="iq-card-header d-flex justify-content-between align-items-center position-relative mb-0 similar-detail">
                <div class="iq-header-title">
                    <h4 class="card-title mb-0">{{$value->name}}</h4>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                    <a href="{{ route('user.material', $value->id) }}" class="btn btn-sm btn-primary view-more">View More</a>
                </div>
            </div>
            <div class="iq-card-body similar-contens">
                <ul id="" class="list-inline p-0 mb-0 row">
                    @foreach($articles as $book)
                    <li class="col-md-3">
                        <div class="d-flex align-items-center">
                            <div class="col-sm-5 p-0 position-relative image-overlap-shadow">
                                <a href="javascript:void();">
                                    @if($book->book_cover_type == "Book Cover")
                                    <img class="img-fluid rounded w-100" src='{{ asset("BOOKCOVER/$book->book_cover") }}' alt="">
                                    @elseif($book->book_cover_type == "Video Cover")
                                    <div class="embed-responsive embed-responsive-1by1">
                                        <iframe class="embed-responsive-item" src='{{ asset("VIDEOCOVER/$book->video_cover") }}' allowfullscreen></iframe>
                                    </div>
                                    @endif
                                </a>
                            </div>
                            <div class="col-sm-7">
                                <div class="mb-2">
                                    <h6 class="mb-1">{{$book->book_name}}</h6>
                                    <p class="font-size-13 line-height mb-1">{{$book->book_author}}</p>
                                    <div class="d-block">
                                        <span class="font-size-13 text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="price d-flex align-items-center">
                                    <h6><b>
                                            @if($book->book_paid_free == "Paid")
                                            ₦{{number_format($book->book_price, 2)}}
                                            @else
                                            Free
                                            @endif
                                        </b>
                                    </h6>
                                </div>
                                <div class="iq-product-action">
                                    <a href="javascript:void();"><i class="ri-shopping-cart-2-fill text-primary"></i></a>
                                    <!-- <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a> -->
                                </div>

                                <div class="mb-2 d-flex align-items-center mt-2">
                                    <!-- <a href="book-pdf.html" class="btn btn-primary view-more mr-2">View Book</a> -->
                                    <a href="{{ route('user.view.book', $book->id) }}" class="btn btn-primary btn-sm mt-3">View Book</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    @endif
</div>
@endsection