@extends('user.layouts.app')
@section('user')
<!-- Page Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="iq-edit-list-data">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Subscription Plan</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    @if($group_admin)
                                    @if(isset($subs))
                                    @foreach($subs as $sub)
                                    <fieldset>
                                        <legend class="text-uppercase font-size-18">{{ $sub->name}}</legend>
                                        <div class="row">
                                            @if($sub->weekly)
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <div class="iq-card">
                                                    <div class="iq-card-body text-center rounded">
                                                        <span class="font-size-14 text-uppercase">Weekly</span>
                                                        <p class="mb-2 font-weight-bolder">₦{{ number_format($sub->weekly, 2) }}<small class="font-size-14 text-muted">/ Weekly</small></p>
                                                        @if(Auth::user()->plan_id == $sub->id && Auth::user()->plan == 'weekly')
                                                        <button type="button" disabled class="btn btn-secondary mt-3">Subscribed</button>
                                                        @else
                                                        <form id="{{ $sub->id }}weeklySub">
                                                            <input type="hidden" id="plan_id" value="{{ $sub->id }}">
                                                            <input type="hidden" id="plan" value="{{ $sub->name }}">
                                                            <input type="hidden" id="plan_type" value="weekly">
                                                            <input type="hidden" id="plan_amount" value="{{ $sub->weekly }}">
                                                            <button type="button" onclick="subPaymentSubmit(event, '{{ $sub->id }}weeklySub')" class="btn btn-primary mt-3">Upgrade</button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if($sub->monthly)
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <div class="iq-card">
                                                    <div class="iq-card-body text-center rounded">
                                                        <span class="font-size-14 text-uppercase">monthly</span>
                                                        <p class="mb-2 font-weight-bolder">₦{{ number_format($sub->monthly, 2) }}<small class="font-size-14 text-muted">/ Monthly</small></p>
                                                        @if(Auth::user()->plan_id == $sub->id && Auth::user()->plan == 'monthly')
                                                        <button type="button" disabled class="btn btn-secondary mt-3">Subscribed</button>
                                                        @else
                                                        <form id="{{ $sub->id }}monthlySub">
                                                            <input type="hidden" id="plan_id" value="{{ $sub->id }}">
                                                            <input type="hidden" id="plan" value="{{ $sub->name }}">
                                                            <input type="hidden" id="plan_type" value="monthly">
                                                            <input type="hidden" id="plan_amount" value="{{ $sub->monthly }}">
                                                            <button type="button" onclick="subPaymentSubmit(event, '{{ $sub->id }}monthlySub')" class="btn btn-primary mt-3">Upgrade</button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if($sub->quarterly)
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <div class="iq-card">
                                                    <div class="iq-card-body text-center rounded">
                                                        <span class="font-size-14 text-uppercase">quarterly</span>
                                                        <p class="mb-2 font-weight-bolder">₦{{ number_format($sub->quarterly, 2) }}<small class="font-size-14 text-muted">/ Quarterly</small></p>
                                                        @if(Auth::user()->plan_id == $sub->id && Auth::user()->plan == 'quarterly')
                                                        <button type="button" disabled class="btn btn-secondary mt-3">Subscribed</button>
                                                        @else
                                                        <form id="{{ $sub->id }}qurterlySub">
                                                            <input type="hidden" id="plan_id" value="{{ $sub->id }}">
                                                            <input type="hidden" id="plan" value="{{ $sub->name }}">
                                                            <input type="hidden" id="plan_type" value="quarterly">
                                                            <input type="hidden" id="plan_amount" value="{{ $sub->quarterly }}">
                                                            <button type="button" onclick="subPaymentSubmit(event, '{{ $sub->id }}qurterlySub')" class="btn btn-primary mt-3">Upgrade</button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if($sub->annually)
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <div class="iq-card">
                                                    <div class="iq-card-body text-center rounded">
                                                        <span class="font-size-14 text-uppercase">annually</span>
                                                        <p class="mb-2 font-weight-bolder">₦{{ number_format($sub->annually, 2) }}<small class="font-size-14 text-muted">/ Annually</small></p>
                                                        @if(Auth::user()->plan_id == $sub->id && Auth::user()->plan == 'annually')
                                                        <button type="button" disabled class="btn btn-secondary mt-3">Subscribed</button>
                                                        @else
                                                        <form id="{{ $sub->id }}annuallySub">
                                                            <input type="hidden" id="plan_id" value="{{ $sub->id }}">
                                                            <input type="hidden" id="plan" value="{{ $sub->name }}">
                                                            <input type="hidden" id="plan_type" value="annually">
                                                            <input type="hidden" id="plan_amount" value="{{ $sub->annually }}">
                                                            <button type="button" onclick="subPaymentSubmit(event, '{{ $sub->id }}annuallySub')" class="btn btn-primary mt-3">Upgrade</button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </fieldset>
                                    @endforeach
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="iq-edit-list-data">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Current subscription</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    @if(isset(Auth::user()->plan_id))
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="iq-card">
                                            <div class="iq-card-body rounded">
                                                <p class="mb-2 font-weight-bolder">Subscribed Plan: <small class="font-size-14 text-muted"><b>{{ Auth::user()->sub_plan->name }} ({{ Auth::user()->plan }})</b></small></p>
                                                <p class="mb-2 font-weight-bolder">Subscribed On: <small class="font-size-14 text-muted"><b>{{ Auth::user()->plan_start }}</b></small></p>
                                                <p class="mb-2 font-weight-bolder">Expires On: <small class="font-size-14 text-muted"><b>{{ Auth::user()->plan_ended }}</b></small></p>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <h5>No active subcription yet</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('user.dashboard.payment')
<script src="https://js.paystack.co/v1/inline.js"></script>
@endsection