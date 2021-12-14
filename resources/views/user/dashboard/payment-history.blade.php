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
                        <h4 class="card-title mb-0">Transactions History</h4>
                    </div>
                    <div class="iq-card-body">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Reference ID</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            @if(isset($transactions))
                            @foreach($transactions as $transaction)
                            <tbody>
                                <tr>
                                    <th scope="row">{{$sn++}}</th>
                                    <td><b>{{$transaction->ref}}</b></td>
                                    <td><b style="color: green;">₦{{ number_format($transaction->amount, 2)}}</b></td>
                                    <td>{{ date('D, M j, Y \a\t g:ia', strtotime($transaction->created_at))}}</td>
                                </tr>
                            </tbody>
                            @endforeach
                            @endif
                        </table>
                    </div>
                    <div class="mt-4 d-flex justify-content-center">
                        @if(isset($transactions))
                        {!! $transactions->links() !!}
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection