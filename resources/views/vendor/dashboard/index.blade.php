@extends('vendor.layouts.app')
@section('vendor')
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
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle iq-card-icon bg-primary"><i class="ri-book-line"></i></div>
                            <div class="text-left ml-3">
                                <h5 class="mb-0"><span class="">Uploaded Materials</span></h5>
                                <h5 class="mb-0"><span class="counter">{{$count_materials ?? 0}}</span></h5>
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
                                <h5 class="mb-0"><span class="counter">{{$count_rented}}</span></h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle iq-card-icon bg-secondary"><i class="ri-book-line"></i></div>
                            <div class="text-left ml-3">
                                <h5 class="mb-0"><span class="">Number of Purchased Material</span></h5>
                                <h5 class="mb-0"><span class="counter">{{$count_sold}}</span></h5>
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
                                <h5 class="mb-0" style="font-weight: 600; color:green">₦<span class="counter">{{ number_format($total_rent, 2) }}</span></h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle iq-card-icon bg-primary"><i class="ri-book-line"></i></div>
                            <div class="text-left ml-3">
                                <h5 class="mb-0"><span class="">Net Amount of Purchased</span></h5>
                                <h5 class="mb-0" style="font-weight: 600; color:green">₦<span class="counter">{{ number_format($total_sold, 2) }}</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 py-4">
                <div class="iq-card shadow iq-card-block iq-card-stretch iq-card-height rounded-new">
                    <div class="iq-card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle iq-card-icon bg-info"><i class="fa fa-users"></i></div>
                            <div class="text-left ml-3">
                                <h5 class="mb-0"><span class="">Rating by Users</span></h5>
                                <!-- <h5 class="mb-0"><span class="counter">500</span></h5> -->
                                <h5 class="mb-0 mt-2">
                                    <div class="mb-3 d-block">
                                        <span class="font-size-20 text-warning">
                                            @if(isset($final_rate))
                                            @if($final_rate == 1)
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            @elseif($final_rate == 2)
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            @elseif($final_rate == 3)
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            @elseif($final_rate == 4)
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1"></i>
                                            <i class="fa fa-star mr-1" style="color: gray;"></i>
                                            @elseif($final_rate == 5)
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
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection