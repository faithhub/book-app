@extends('admin.layouts.app')
@section('admin')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Edit Policy</h4>
                    </div>
                    <div class="iq-card-body pb-0">
                        <div class="pl-2 pr-2">
                            <form method="POST" action="{{ route('admin.edit.policy') }}">
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col-12 form-group">
                                        <textarea class="form-control" name="policy" id="summernote" rows="10">{{$policy->policy ?? ""}}</textarea>
                                        @error('policy')
                                        <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-right pb-2">
                                    <a href="{{ route('admin.policy') }}" class="btn btn-primary">Back to Policy</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection