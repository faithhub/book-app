@extends('user.layouts.app')
@section('user')

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle iq-card-icon bg-primary"><i class="ri-user-line"></i></div>
                            <div class="text-left ml-3">
                                <h2 class="mb-0"><span class="counter">5000</span></h2>
                                <h5 class="">Users</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle iq-card-icon bg-danger"><i class="ri-book-line"></i></div>
                            <div class="text-left ml-3">
                                <h2 class="mb-0"><span class="counter">4.8</span>k</h2>
                                <h5 class="">Books</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle iq-card-icon bg-warning"><i class="ri-shopping-cart-2-line"></i></div>
                            <div class="text-left ml-3">
                                <h2 class="mb-0"><span class="counter">1.2</span>k</h2>
                                <h5 class="">Sale</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle iq-card-icon bg-info"><i class="ri-radar-line"></i></div>
                            <div class="text-left ml-3">
                                <h2 class="mb-0"><span class="counter">690</span></h2>
                                <h5 class="">Orders</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection