@extends('admin.layouts.app')
@section('admin')
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Edit About Us</h4>
                    </div>
                    <div class="iq-card-body pb-0">
                        <div class="pl-2 pr-2">
                            <form method="POST" action="{{ route('admin.edit.about') }}">
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col-12 form-group">
                                        <textarea class="form-control" name="about" id="summernote" rows="10">{{$about->about ?? ""}}</textarea>
                                        @error('about')
                                        <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-right pb-2">
                                    <a href="{{ route('admin.about') }}" class="btn btn-primary">Back to About Us</a>
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
<script src="{{ asset('js/editor.js') }}"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script> -->
<script>
    $('.textarea').wysihtml5();
    // $(document).ready(function() {
    //     $("#summernote").Editor();

    // });

    // $("#summernote").Editor();
    // $('#summernote').summernote();
    // var editor = $("#editable").Editor();
    // $("#editable").Editor("getText");
</script>
@endsection