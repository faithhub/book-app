@extends('user.layouts.app')
@section('user')
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
            <div class="col-lg-12">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Group Member</h4>
                        @if(Auth::user()->id == $group->user_id)
                        <div class="text-right">
                            @if(count($group->group_members) >= 5)
                            <button class="btn btn-dark" style="cursor: no-drop;">Maximum Member Reached</button>
                            @else
                            <a href="{{ route('user.create.group.member') }}" class="btn btn-primary">Add New Member</a>
                            @endif
                        </div>
                        @endif
                    </div>
                    <div class="iq-card-body">
                        <table class="data-tables table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Date of Birth</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Reg. Date</th>
                                    @if(Auth::user()->id == $group->user_id)
                                    <th scope="col">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            @if(isset($users))
                            @foreach($users as $user)
                            <tbody>
                                <tr>
                                    <th scope="row">{{$sn++}}</th>
                                    <td><b>{{$user->username}}</b></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>{{ $user->dob }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ date('D, M j, Y \a\t g:ia', strtotime($user->created_at))}}</td>
                                    @if(Auth::user()->id == $group->user_id)
                                    <td>
                                        @if($user->id != $group->user_id)
                                        <a href="{{ route('user.delete.group.member', $user->id) }}" onclick="return confirm('Are you sure you want to delete this member?')" class="btn"><i class="fa fa-trash"></i></a>
                                        @else
                                        <span class="badge badge-primary">Group Admin</span>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                            </tbody>
                            @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection