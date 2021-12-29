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
            <div class="col-lg-12">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Users</h4>
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
                                </tr>
                            </tbody>
                            @endforeach
                            @endif
                        </table>
                    </div>
                    <!-- <div class="mt-4 d-flex justify-content-center">
                        @if(isset($users))
                        {!! $users->links() !!}
                        @endif
                    </div> -->
                </div>
            </div>

        </div>
    </div>
</div>
@endsection