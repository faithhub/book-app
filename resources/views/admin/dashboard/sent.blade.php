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
                                <li class="list-group-item d-flex justify-content-between align-items-center">Create
                                    <span class="badge badge-primary badge-pill">New</span>
                                </li>
                            </a>

                            <a href="{{ route('vendor.inbox') }}">
                                <li class="list-group-item d-flex justify-content-between align-items-center">Inbox
                                    <span class="badge badge-primary badge-pill">{{ $inbox_count ?? '0' }}</span>
                                </li>
                            </a>

                            <a href="{{ route('vendor.sent') }}">
                                <li class="list-group-item shadow active-now-inbox d-flex justify-content-between align-items-center">Sent
                                    <span class="badge badge-primary badge-pill">{{ $sent_count ?? '0' }}</span>
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Sent Messages</h4>
                    </div>
                    <div class="iq-card-body pb-4">
                        <ul class="list-inline pb-3 m-0">
                            @if(isset($messages))
                            @foreach($messages as $message)
                            <li class="checkout-product">
                                <div class="row align-items-center">
                                    <div class="col-sm-6 col-lg-6">
                                        Subject:
                                        <div class="checkout-product-details">
                                            <h5>{{$message->subject}}</h5>
                                            <!-- <p class="text-success">In stock</p>
                                            <div class="price">
                                                <h5>$180.00</h5>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-4">
                                        Date Sent:
                                        <div class="row align-items-center">
                                            <div class="col-sm-12">
                                                <b>{{ date('D, M j, Y \a\t g:ia', strtotime($message->created_at))}}</b>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-lg-2">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <a href="#"><button type="submit" data-toggle="modal" data-target="#viewMessageSent{{$message->id}}" class="btn btn-primary view-more">View</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!-- Modal -->
                            <div class="modal fade" id="viewMessageSent{{$message->id}}" tabindex="-1" role="dialog" aria-labelledby="viewMessageSentLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewMessageSentLabel">View Message</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row align-items-center">
                                                <div class="form-group col-sm-12">
                                                    <label for="cpass"><b>Support Email:</b></label>
                                                    <input type="text" class="form-control" id="cpass" value="Support@gmail.com" disabled>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="cpass"><b>Date Sent:</b></label>
                                                    <input type="text" class="form-control" id="cpass" value="{{ date('D, M j, Y \a\t g:ia', strtotime($message->created_at))}}" disabled>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="cpass"><b>Subject:</b></label>
                                                    <p>{{$message->subject}}</p>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="npass"><b>Content:</b></label>
                                                    <p>{{$message->content}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </ul>

                        <div class="mt-4 d-flex justify-content-center">
                            @if(isset($messages))
                            {!! $messages->links() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection