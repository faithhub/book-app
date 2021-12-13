<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="iq-menu-bt d-flex align-items-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="las la-bars"></i></div>
                </div>
                <div class="iq-navbar-logo d-flex justify-content-between">
                    <a href="index.html" class="header-logo">
                        <img src="{{ asset('logos/logo.png') }}" class="img-fluid rounded-normal" alt="">
                        <div class="logo-title">
                            <span class="text-primary text-uppercase">VLL AFRICA</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="navbar-breadcrumb">
                <h5 class="mb-0 active text-capitalize" style="letter-spacing: 2px;">Welcome {{Auth::user()->name}}</h5>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-list">
                    <li class="nav-item nav-icon dropdown">
                        <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                            <i class="ri-shopping-cart-2-line"></i>
                            <span class="badge badge-danger count-cart rounded-circle">{{Session::get('my_cart_count') ?? '0' }}</span>
                        </a>
                        <div class="iq-sub-dropdown">
                            <div class="iq-card shadow-none m-0">
                                <div class="iq-card-body p-0 toggle-cart-info">
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white">All Carts<small class="badge  badge-light float-right pt-1">{{Session::get('my_cart_count') ?? '0' }}</small></h5>
                                    </div>
                                    <?php $my_carts = Session::get('my_carts') ?>
                                    @if(isset($my_carts))
                                    @foreach($my_carts as $cart)
                                    <a href="" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                @if($cart->book->book_cover_type == "Book Cover")
                                                <img class="img-fluid rounded" src="{{ asset('BOOKCOVER/'.$cart->book->book_cover) }}" alt="">
                                                @elseif($cart->book->book_cover_type == "Video Cover")
                                                <iframe src="{{ asset('VIDEOCOVER/'.$cart->book->video_cover) }}" width="60" height="50" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                                                @endif
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 text-capitalize">{{$cart->book->book_name}}</h6>
                                                <p class="mb-0">₦{{number_format($cart->book->book_price, 2)}}</p>
                                            </div>
                                            <form action="{{ route('user.remove.cart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="book_id" value="{{$cart->book->id}}">
                                                <div class="float-right font-size-24 text-danger"><button onclick="return confirm('Are you sure you want to remove this book from cart?')"><i class="ri-close-fill"></i></button></div>
                                            </form>
                                        </div>
                                    </a>
                                    @endforeach
                                    @endif
                                    <div class="d-flex align-items-center text-center p-3">
                                        <a class="btn btn-primary mr-2 iq-sign-btn" href="#" role="button">View Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="line-height pt-3">
                        <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                            <div class="caption">
                                <h6 class="mb-1 line-height text-capitalize" style="font-weight: 600 !important; letter-spacing: 2px;">{{ Auth::user()->username }}</h6>
                                <p class="mb-0" style="color: green; letter-spacing: 2px; font-weight: 600 !important;">Online</p>
                            </div>
                        </a>
                        <div class="iq-sub-dropdown iq-user-dropdown">
                            <div class="iq-card shadow-none m-0">
                                <div class="iq-card-body p-0 ">
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white line-height text-capitalize" style="font-weight: 600 !important; letter-spacing: 2px;">{{ Auth::user()->username }}</h5>
                                    </div>
                                    <a href="{{ route('user.profile') }}" class="iq-sub-card iq-bg-primary-hover">
                                        <div class="media align-items-center">
                                            <div class="rounded iq-card-icon iq-bg-primary">
                                                <i class="ri-file-user-line"></i>
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">My Profile</h6>
                                                <p class="mb-0 font-size-12">View personal profile details.</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="{{ route('user.change.password') }}" class="iq-sub-card iq-bg-primary-hover">
                                        <div class="media align-items-center">
                                            <div class="rounded iq-card-icon iq-bg-primary">
                                                <i class="ri-account-box-line"></i>
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">Change Password</h6>
                                                <p class="mb-0 font-size-12">Update your account password.</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="d-inline-block w-100 text-center p-3">
                                        <a class="bg-primary iq-sign-btn" href="{{ route('user.logout') }}" role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>