<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="index.html" class="header-logo">
            <img src="{{ asset('logos/logo.png') }}" class="img-fluid rounded-normal" alt="">
            <div class="logo-title">
                <span class="text-primary text-uppercase">VLL AFRICA</span>
            </div>
        </a>
        <div class="iq-menu-bt-sidebar">
            <div class="iq-menu-bt align-self-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="las la-bars"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="active active-menu">
                    <a href="admin-dashboard.html" class="active"><i class="las la-house-damage"></i>Dashboard</a>
                </li>
                <li>
                    <a href="admin-dashboard.html" class="active"><i class="ri-file-pdf-line"></i>Bookshop</a>
                </li>
                <li class="">
                    <a href="#admin" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false"><span class="ripple rippleEffect"></span><i class="ri-book-line iq-arrow-left"></i><span>My Library</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                    <ul id="admin" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li><a href=""><i class="ri-book-line"></i>Bought Book</a></li>
                        <li><a href=""><i class="ri-book-line"></i>Rent Books</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="admin-dashboard.html" class="active"><i class="ri-checkbox-multiple-blank-line"></i>Checkout</a>
                </li>
                <li>
                    <a href="admin-dashboard.html" class="active"><i class="ri-heart-line"></i>Watchlist</a>
                </li>
                
                <li class="{{ request()->is('vendor/profile') || request()->is('vendor/edit-profile') || request()->is('vendor/change-password')  ? 'active active-menu' : '' }}">
                    <a href="#settings" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false"><span class="ripple rippleEffect"></span><i class="las la-th-list iq-arrow-left"></i><span>Settings</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                    <ul id="settings" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->is('vendor/profile')  ? 'active' : '' }}"><a href="{{ route('vendor.profile') }}"><i class="las la-id-card-alt"></i>My Profile</a></li>
                        <li class="{{ request()->is('vendor/change-password')  ? 'active' : '' }}"><a href="{{ route('vendor.change.password') }}"><i class="ri-lock-line"></i>Change Password</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="{{ route('vendor.logout') }}" class="active"><i class="ri-file-pdf-line"></i>Logout</a>
                </li>
            </ul>
        </nav>
        <!-- <div id="sidebar-bottom" class="p-3 position-relative">
            <div class="iq-card">
                <div class="iq-card-body">
                    <div class="sidebarbottom-content">
                        <div class="image"><img src="images/page-img/side-bkg.png" alt=""></div>
                        <button type="submit" class="btn w-100 btn-primary mt-4 view-more">Become Membership</button>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>