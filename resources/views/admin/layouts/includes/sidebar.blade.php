<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="{{ route('vendor.dashboard') }}" class="header-logo">
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

                <li class="{{ request()->is('admin')  ? 'active active-now' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" ><i class="fa fa-home"></i><span>Dashboard</span></a>
                </li>

                <!-- <li class="{{ request()->is('vendor/my-books') || request()->is('vendor/view-book/*')  ? 'active active-now' : '' }}">
                    <a href="{{ route('vendor.my.books') }}"><i class="fa fa-users"></i><span>Admins</span></a>
                </li> -->
                <li class="{{ request()->is('admin/vendors') ? 'active active-now' : '' }}">
                    <a href="{{ route('admin.vendors') }}"><i class="fa fa-users"></i><span>Vendors</span></a>
                </li>

                <li class="{{ request()->is('admin/users') ? 'active active-now' : '' }}">
                    <a href="{{ route('admin.users') }}"><i class="fa fa-users"></i><span>Users</span></a>
                </li>

                <li class="{{ request()->is('vendor/inbox') || request()->is('vendor/sent') || request()->is('vendor/create')  ? 'active active-now' : '' }}">
                    <a href="{{ route('vendor.inbox') }}"><i class="fa fa-envelope-open"></i><span>Inbox</span></a>
                </li>

                <li class="{{ request()->is('vendor/about')  ? 'active active-now' : '' }}">
                    <a href="{{ route('vendor.about') }}"><i class="fa fa-address-book"></i><span>Policy</span></a>
                </li>
                
                <li class="{{ request()->is('vendor/about')  ? 'active active-now' : '' }}">
                    <a href="{{ route('vendor.about') }}"><i class="fa fa-address-book"></i><span>About Us</span></a>
                </li>

                <li class="{{ request()->is('admin/profile') || request()->is('admin/change-password')  ? 'active active-now' : '' }}">
                    <a href="#settings" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false"><span class="ripple rippleEffect"></span><i class="fa fa-cog iq-arrow-left"></i><span>Settings</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                    <ul id="settings" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->is('admin/profile')  ? 'active active-now' : '' }}"><a href="{{ route('admin.profile') }}"><i class="las la-id-card-alt"></i>My Profile</a></li>
                        <li class="{{ request()->is('admin/change-password')  ? 'active active-now' : '' }}"><a href="{{ route('admin.change.password') }}"><i class="ri-lock-line"></i>Change Password</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.logout') }}"><i class="fa fa-power-off"></i><span>Logout</span></a>
                </li>
            </ul>
        </nav>
    </div>
</div>