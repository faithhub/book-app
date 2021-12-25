@extends('admin.layouts.app')
@section('admin')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Policy</h4>
                    </div>
                    <div class="iq-card-body pb-0">
                        <div class="description-contens align-items-top row">
                            <div class="pl-2 pr-2">
                                <!-- <h4 class="text-center">VLL Africa</h4> -->
                                {!! $policy->policy ?? "" !!}
                            </div>
                            <div class="text-right p-3">
                                <a href="{{ route('admin.edit.policy') }}" class="btn btn-primary">Edit Policy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection