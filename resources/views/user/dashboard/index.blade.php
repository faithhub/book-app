@extends('user.layouts.app')
@section('user')
<div id="content-page" class="content-page">
    <form class="col-12 d-flex" method="POST" action="{{ route('user.search') }}">
    @csrf
        <input type="hidden" name="type" value="Material">
        <div class="form-group col-md-12">
            <select class="form-control" onchange='if(this.value != "") { this.form.submit(); }' name="mat_id" id="exampleFormControlSelect1">
                <option value="">Search Material Type</option>
                @if(isset($mats))
                @foreach($mats as $mat)
                <option value="{{$mat->id}}">{{$mat->name}}</option>
                @endforeach
                @endif
            </select>
            @error('gender')
            <span class="invalid-feedback" role="alert" style="display: block">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <!-- <div class="form-group col-md-2">
            <button type="submit" class="btn btn-primary mr-2">Search</button>
        </div> -->
    </form>
    @if(isset($books))
    @foreach($mats as $value)
    <?php
    $articles = \App\Models\Book::where('book_material_type', $value->id)->orderBy('id', 'desc')->take(4)->get();
    ?>

    @if($articles->count() > 0)
    <div class="col-lg-12">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div class="iq-card-header d-flex justify-content-between align-items-center position-relative mb-0 similar-detail">
                <div class="iq-header-title">
                    <h4 class="card-title mb-0">{{$value->name}}</h4>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                    <a href="{{ url('user/view-book-type/'.$value->name.'/'.$value->id) }}" class="btn btn-sm btn-primary view-more">View More</a>
                </div>
            </div>
            <div class="iq-card-body similar-contens">
                <ul id="" class="list-inline p-0 mb-0 row">
                    @foreach($articles as $book)
                    <li class="col-md-3">
                        <div class="d-flex align-items-center">
                            <div class="col-sm-5 p-0 position-relative">
                                <a href="javascript:void();">
                                    @if($book->book_cover_type == "Book Cover")
                                    <img class="img-fluid rounded w-100" src='{{ asset("BOOKCOVER/$book->book_cover") }}' alt="">
                                    @elseif($book->book_cover_type == "Video Cover")
                                    <video class="embed-responsive embed-responsive-1by1" loop controls muted>
                                        <source src="{{ asset('VIDEOCOVER/'.$book->video_cover) }}" type="video/mp4" />
                                    </video>
                                    @endif
                                </a>
                            </div>
                            <div class="col-sm-7">
                                <div class="mb-2">
                                    <h6 class="mb-1">{{$book->book_name}}</h6>
                                    <p class="font-size-13 line-height mb-1">{{$book->book_author}}</p>
                                    <div class="d-block">
                                        <span class="font-size-20 text-warning">
                                            @if(isset($book->rate))
                                            @if($book->rating == 1)
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            @elseif($book->rating == 2)
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            @elseif($book->rating == 3)
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            @elseif($book->rating == 4)
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            @elseif($book->rating == 5)
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
                                    @if($book->book_paid_free == "Paid")
                                    <?php
                                    $carts = Session::get('user_carts');
                                    $boughts_books = Session::get('boughts_books');
                                    $rented_books = Session::get('rented_books');
                                    ?>

                                    @if(in_array($book->id, $boughts_books))
                                    <i class="ri-shopping-cart-2-fill p-1 text-primary cart btn" style="cursor: text;">Bought</i>
                                    @elseif(in_array($book->id, $rented_books))
                                    <i class="ri-shopping-cart-2-fill p-1 text-primary cart btn" style="cursor: text;">Rent</i>
                                    @elseif(in_array($book->id, $carts))
                                    <i class="ri-shopping-cart-2-fill p-1 text-primary cart btn" style="cursor: text;">Added</i>
                                    @else
                                    <form action="{{ route('user.add.cart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{$book->id}}">
                                        <button id="add-to-cart" class="p-1 rounded"><i class="ri-shopping-cart-2-fill text-primary cart shadow">Add to Cart</i></button>
                                    </form>
                                    @endif
                                    @else
                                    <button id="add-to-cart" class="p-1 rounded"><i class="ri-shopping-cart-2-fill text-primary cart shadow">Free</i></button>
                                    @endif
                                </div>

                                <div class="mb-2 d-flex align-items-center mt-2">
                                    <a href="{{ url('user/view-book/'.$book->book_name.'/'.$book->id) }}" class="btn btn-primary btn-sm mt-3">View Book</a>
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