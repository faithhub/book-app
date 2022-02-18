@extends('vendor.layouts.app')
@section('vendor')
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
            <div class="col-lg-4">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Vendor Inbox</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <ul class="list-group list-group-flush">
                            <a href="{{ route('vendor.create') }}">
                                <li class="list-group-item shadow active-now-inbox d-flex justify-content-between align-items-center">Create
                                    <span class="badge badge-primary badge-pill">New</span>
                                </li>
                            </a>

                            
                            <a href="{{ route('vendor.inbox') }}">
                                <li class="list-group-item d-flex justify-content-between align-items-center">Inbox
                                    <span class="badge badge-primary badge-pill">{{ $inbox_count ?? '0' }}</span>
                                </li>
                            </a>

                            <a href="{{ route('vendor.sent') }}">
                                <li class="list-group-item d-flex justify-content-between align-items-center">Sent
                                    <span class="badge badge-primary badge-pill">{{ $sent_count ?? '0' }}</span>
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <!-- <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0"></h4>
                    </div> -->
                    <div class="iq-card-body pb-0">
                        <form method="POST" action="{{ route('vendor.create') }}" enctype="multipart/form-data" class="pb-4">
                            @csrf
                            <input type="hidden" name="vendor_id" value="{{Auth::guard('vendor')->user()->id}}">
                            <div class="row align-items-center">
                                <div class="form-group col-sm-12">
                                    <label for="cpass"><b>Support Email:</b></label>
                                    <input type="text" class="form-control" id="cpass" value="{{ env('ADMIN_MAILER') }}" disabled>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="cpass"><b>Subject:</b></label>
                                    <input type="text" class="form-control" id="cpass" value="{{old('subject')}}" name="subject">
                                    @error('subject')
                                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="npass"><b>Content:</b></label>
                                    <textarea name="content" id="npass" class="form-control">{{old('content')}}</textarea>
                                    @error('content')
                                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection