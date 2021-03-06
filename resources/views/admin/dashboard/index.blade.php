@extends('admin.layouts.app')
@section('admin')
<style>
    .rounded-new {
        border-radius: 30px;
    }

    h5 {
        font-weight: 600;
    }
</style>
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-6 py-4">
                <div class="iq-card shadow iq-card-block iq-card-stretch iq-card-height rounded-new">
                    <div class="iq-card-body">
                        
                    <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle iq-card-icon bg-success"><i class="fa fa-users"></i></div>
                            <div class="text-left ml-3">
                                <h5 class="mb-0"><span class="">Admins</span></h5>
                                <h5 class="mb-0"><span class="counter">{{$admin_count ?? 0}}</span></h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle iq-card-icon bg-primary"><i class="fa fa-users"></i></div>
                            <div class="text-left ml-3">
                                <h5 class="mb-0"><span class="">Vendors</span></h5>
                                <h5 class="mb-0"><span class="counter">{{$vendor_count ?? 0}}</span></h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle iq-card-icon bg-secondary"><i class="fa fa-users"></i></div>
                            <div class="text-left ml-3">
                                <h5 class="mb-0"><span class="">Users</span></h5>
                                <h5 class="mb-0"><span class="counter">{{$user_count ?? 0}}</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 py-4">
                <div class="iq-card shadow iq-card-block iq-card-stretch iq-card-height rounded-new">
                    <div class="iq-card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle iq-card-icon bg-warning"><i class="ri-book-line"></i></div>
                            <div class="text-left ml-3">
                                <h5 class="mb-0"><span class="">Number of Rented Material</span></h5>
                                <h5 class="mb-0"><span class="counter">{{$count_rented ?? 0}}</span></h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle iq-card-icon bg-secondary"><i class="ri-book-line"></i></div>
                            <div class="text-left ml-3">
                                <h5 class="mb-0"><span class="">Number of Purchased Material</span></h5>
                                <h5 class="mb-0"><span class="counter">{{$count_sold ?? 0}}</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 py-4">
                <div class="iq-card shadow iq-card-block iq-card-stretch iq-card-height rounded-new">
                    <div class="iq-card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle iq-card-icon bg-success"><i class="ri-book-line"></i></div>
                            <div class="text-left ml-3">
                                <h5 class="mb-0"><span class="">Net Amount of Rented</span></h5>
                                <h5 class="mb-0" style="font-weight: 600; color:green">???<span class="counter">{{ number_format($total_rent ?? 0, 2) }}</span></h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle iq-card-icon bg-primary"><i class="ri-book-line"></i></div>
                            <div class="text-left ml-3">
                                <h5 class="mb-0"><span class="">Net Amount of Purchased</span></h5>
                                <h5 class="mb-0" style="font-weight: 600; color:green">???<span class="counter">{{ number_format($total_sold ?? 0, 2) }}</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 py-4">
                <div class="iq-card shadow iq-card-block iq-card-stretch iq-card-height rounded-new">
                    <div class="iq-card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle iq-card-icon bg-secondary"><i class="ri-book-line"></i></div>
                            <div class="text-left ml-3">
                                <h5 class="mb-0"><span class="">Uploaded Material</span></h5>
                                <h5 class="mb-0"><span class="counter">{{$all_books ?? 0}}</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection