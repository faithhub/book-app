@extends('user.layouts.app')
@section('user')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between align-items-center position-relative mb-0 similar-detail">
                        <div class="iq-header-title">
                            <h4 class="card-title mb-0">Search Result</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                        </div>
                    </div>
                    <div class="iq-card-body similar-contens">
                        <ul id="" class="list-inline p-0 mb-0 row">
                            @if(isset($books))
                            @if($books->count() > 0)

                            @foreach($books as $book)
                            <li class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="col-sm-5 p-0 position-relative image-overlap-shadow">
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
                                            </span>
                                            <p class="font-size-13 line-height mb-1">Author: {{$book->book_author}}</p>
                                            <p class="font-size-13 line-height mb-1">Type: {{$book->material->name}}</p>
                                            <div class="d-block">

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
                            @else
                            <div class="col-sm-6 offset-sm-3">
                                <h3 class="text-center">{{$result ?? '' }}</h3>
                            </div>
                            @endif
                            @else
                            <div class="col-sm-6 offset-sm-3">
                                <h3 class="text-center">{{$result ?? '' }}</h3>
                            </div>
                            @endif
                        </ul>
                    </div>
                    <div class="mt-4 d-flex justify-content-center">
                        @if(isset($books))
                        {!! $books->links() !!}
                        @endif
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