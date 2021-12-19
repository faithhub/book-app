@extends('vendor.layouts.app')
@section('vendor')
<!-- Page Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">My Materials</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <a href="{{ route('vendor.upload.new.book') }}" class="btn btn-primary">Add New Material</a>
                        </div>
                    </div>
                    <div class="iq-card-body single-similar-contens">
                        <ul class="list-inline p-0 mb-0 row">
                            @if(isset($books))
                            @foreach($books as $book)
                            <li class="col-md-3 mb-2">
                                <div class="iq-card pr-2 pl-2 pb-3 pt-3 shadow">
                                    <div class="row align-items-center">
                                        <div class="col-5">
                                            <div class="position-relative image-overlap-shadow">
                                                <a href="javascript:void();">
                                                    @if($book->book_cover_type == "Book Cover")
                                                    <img class="img-fluid rounded w-100" src='{{ asset("BOOKCOVER/$book->book_cover") }}' alt="">
                                                    @elseif($book->book_cover_type == "Video Cover")
                                                    <video class="embed-responsive embed-responsive-1by1" loop controls muted>
                                                        <source src="{{ asset('VIDEOCOVER/'.$book->video_cover) }}" type="video/mp4" />
                                                    </video>
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-7 pl-0">
                                            <h5 class="mb-2">{{$book->book_name}}</h5>
                                            <p class="text-body">Author : <b>{{$book->book_author}}</b></p>
                                            <a href="{{ route('vendor.view.book', $book->id) }}" class="btn btn-primary mt-3">View <i class="ri-arrow-right-s-line"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="mt-4 d-flex justify-content-center">
                        @if(isset($books))
                        {!! $books->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection