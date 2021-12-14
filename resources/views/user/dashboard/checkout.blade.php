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
                        <h4 class="card-title mb-0">Checkout</h4>
                    </div>
                    <div class="iq-card-body">
                        <ul class="list-inline p-0 m-0">
                            @if(isset($all_carts))
                            @foreach($all_carts as $cart)
                            <li class="checkout-product">
                                <div class="row align-items-center">
                                    <div class="col-sm-2">
                                        <span class="checkout-product-img">
                                            <a href="javascript:void();">
                                                @if($cart->book->book_cover_type == "Book Cover")
                                                <img class="img-fluid rounded" src="{{ asset('BOOKCOVER/'.$cart->book->book_cover) }}" alt="">
                                                @elseif($cart->book->book_cover_type == "Video Cover")
                                                <video class="video-fluid z-depth-1" style="height: 100%; width: 80%; margin: auto;" loop controls muted>
                                                    <source src="{{ asset('VIDEOCOVER/'.$cart->book->video_cover) }}" type="video/mp4" />
                                                </video>
                                                @endif
                                            </a>
                                        </span>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="checkout-product-details">
                                            <a href="{{ url('user/view-book/'.$cart->book->book_name.'/'.$cart->book->id) }}">
                                                <h5>{{$cart->book->book_name}}</h5>
                                            </a>
                                            <p class="text-primary mb-0">Author: {{$cart->book->book_author}}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="row align-items-center mt-2">
                                                    <div class="col-sm-5 col-md-6">
                                                        <span class="product-price" style="color: green; font-weight: 600;">₦{{number_format($cart->book->book_price, 2)}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <form action="{{ route('user.remove.cart') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="book_id" value="{{$cart->book->id}}">
                                                    <div class="float-right font-size-10"><button class="p-1 btn-sm btn-primary" onclick="return confirm('Are you sure you want to remove this book from cart?')" style="font-size: 15px;"><i class="ri-delete-bin-7-fill"> </i>Remove</button></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Total Amount</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="form-group col-sm-12">
                                @if(isset($all_carts))
                                <?php $total = 0 ?>
                                @foreach($all_carts as $cart)
                                <?php $total += $cart->book->book_price ?>
                                @endforeach
                                @endif
                            <b style="color: green; font-size: 20px;">₦{{number_format($total, 2)}}</b>
                        </div>
                            <form id="paymentForm">
                                <input type="hidden" value="{{Auth::user()->email}}" id="email-address">
                                <input type="hidden" id="first-name" value="{{Auth::user()->name}}" />
                                <input type="hidden" id="amount" value="{{$total}}"  required />
                                <button type="submit" onclick="payWithPaystack()" class="btn btn-primary btn-block d-block mt-3" style="font-size: 20px; letter-spacing: 2px;">Make Payment</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('user.dashboard.payment')
<script src="https://js.paystack.co/v1/inline.js"></script>
@endsection