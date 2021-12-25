@extends('admin.layouts.app')
@section('admin')
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
            <div class="col-lg-3">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Admin Inbox</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <ul class="list-group list-group-flush">
                            <a href="{{ route('admin.create') }}">
                                <li class="list-group-item d-flex justify-content-between align-items-center">Create
                                    <span class="badge badge-primary badge-pill">New</span>
                                </li>
                            </a>

                            <a href="{{ route('admin.inbox') }}">
                                <li class="list-group-item d-flex justify-content-between align-items-center">Inbox
                                    <span class="badge badge-primary badge-pill">{{ $inbox_count ?? '0' }}</span>
                                </li>
                            </a>

                            <a href="{{ route('admin.sent') }}">
                                <li class="list-group-item shadow active-now-inbox d-flex justify-content-between align-items-center">Sent
                                    <span class="badge badge-primary badge-pill">{{ $sent_count ?? '0' }}</span>
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Inbox Messages</h4>
                    </div>
                    <div class="iq-card-body pb-4">
                        <table class="data-tables table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Vendor</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($messages))
                                @foreach($messages as $message)
                                <tr>
                                    <th scope="row">{{$sn++}}</th>
                                    <td><b>{{$message->vendor->name}}</b></td>
                                    <td>{{ Str::limit($message->subject, 20, '....') }}</td>
                                    <td>{{ date('D, M j, Y', strtotime($message->created_at))}}</td>
                                    <td>
                                        <a href="#"><button type="submit" data-toggle="modal" data-target="#viewMessageSent{{$message->id}}" class="btn btn-primary view-more">View</button></a>
                                    </td>
                                </tr>

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
                                                        <label for="cpass"><b>Vendor:</b></label>
                                                        <input type="text" class="form-control" id="cpass" value="{{$message->vendor->name}} ({{$message->vendor->email}})" disabled>
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

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection