@extends('vendor.layouts.app')
@section('vendor')
<!-- Page Content  -->

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
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
                            <li class="col-md-4 mb-2">
                                <div class="iq-card pr-2 pl-2 pb-3 pt-3 shadow">
                                    <div class="row align-items-center">
                                        <div class="col-5">
                                            <div class="position-relative image-overlap-shadow">
                                                <a href="javascript:void();">
                                                    @if($book->book_cover_type == "Book Cover")
                                                    <img class="img-fluid rounded w-100" src='{{ asset("BOOKCOVER/$book->book_cover") }}' alt="">
                                                    @elseif($book->book_cover_type == "Video Cover")
                                                    <div class="embed-responsive embed-responsive-1by1">
                                                        <iframe class="embed-responsive-item" src='{{ asset("VIDEOCOVER/$book->video_cover") }}' allowfullscreen></iframe>
                                                    </div>
                                                    @endif
                                                </a>
                                                <!-- <div class="view-book">
                                                    <a href="{{ route('vendor.view.book', $book->id) }}" class="btn btn-sm btn-white">View Material</a>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="col-7 pl-0">
                                            <h4 class="mb-2">{{$book->book_name}}</h4>
                                            <p class="text-body">Author : <b>{{$book->book_author}}</b></p>
                                            <a href="{{ route('vendor.view.book', $book->id) }}" class="btn btn-primary mt-3">Read Now <i class="ri-arrow-right-s-line"></i></a>
                                            <!-- <a href="{{ route('vendor.view.book', $book->id) }}" class="text-dark" tabindex="-1">Read Now</a> -->
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
            
            <div class="col-lg-3">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Search Materials</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">

                        <div class="form-group col-sm-12">
                            <label for="cpass"><b>Title of Material:</b></label>
                            <input type="text" class="form-control" id="cpass" value="{{old('book_name')}}" name="book_name">
                            @error('book_name')
                            <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="cpass"><b>Name of Author:</b></label>
                            <input type="text" class="form-control" id="cpass" value="{{old('book_author')}}" name="book_author">
                            @error('book_author')
                            <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="cpassk"><b>Category</b></label>
                            <select class="form-control" id="cpassk" name="book_cat" id="exampleFormControlSelect1">
                                <option value="">Select a Category</option>
                                @if(isset($book_cats))
                                @foreach($book_cats as $cats)
                                <option value="{{$cats->id}}" {{ old('book_cat') == $cats->id ? "selected" : '' }}>{{$cats->name}}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('book_cat')
                            <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="cpassk"><b>Type of Material</b></label>
                            <select class="form-control" id="materialTypeID" name="book_material_type" id="exampleFormControlSelect1">
                                <option value="">Select a Type</option>
                                @if(isset($materials))
                                @foreach($materials as $cats)
                                <option value="{{$cats->id}}" {{ old('book_material_type') == $cats->id ? "selected" : '' }}>{{$cats->name}}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('book_material_type')
                            <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="cpass"><b>Tag:</b></label>
                            <input type="text" class="form-control" id="cpass" value="{{old('book_tag')}}" name="book_tag">
                            @error('book_tag')
                            <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="cpassk"><b>Paid/Free</b></label>
                            <select class="form-control" id="bookPriceID" onchange="bookPrice(this.value)" name="book_paid_free" id="exampleFormControlSelect1">
                                <option value="">Choose One</option>
                                <option value="Paid" {{ old('book_paid_free') == 'Paid' ? "selected" : '' }}>Paid</option>
                                <option value="Free" {{ old('book_paid_free') == 'Free' ? "selected" : '' }}>Free</option>
                            </select>
                            @error('book_paid_free')
                            <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block d-block mt-3 next">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- <div class="table-responsive">
                            <table class="data-tables table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th style="width: 20%;">Book Title</th>
                                        <th style="width: 20%;">Author Name</th>
                                        <th style="width: 5%;">Profile</th>
                                        <th style="width: 60%;">Author Description</th>
                                        <th style="width: 10%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($books))
                                    @foreach($books as $book)
                                    <p>{{$book}}</p>
                                    <tr>
                                        <td>{{$sn++}}</td>
                                        <td>{{$book->book_name}}</td>
                                        <td>{{$book->book_author}}</td>
                                        <td>
                                            @if($book->book_cover_type == "Book Cover")
                                            <img src="images/user/01.jpg" class="img-fluid avatar-50 rounded" alt="author-profile">
                                            @elseif($book->book_cover_type == "Video Cover")
                                            @endif
                                        </td>
                                        <td>
                                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet</p>
                                        </td>
                                        <td>
                                            <div class="flex align-items-center list-user-action">
                                                <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="admin-add-category.html"><i class="ri-pencil-line"></i></a>
                                                <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    <tr>
                                        <td>10</td>
                                        <td>
                                            <img src="images/user/10.jpg" class="img-fluid avatar-50 rounded" alt="author-profile">
                                        </td>
                                        <td>Attilio Marzi</td>
                                        <td>
                                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus non elit a scelerisque. Etiam feugiat luctus est, vel commodo odio rhoncus sit amet</p>
                                        </td>
                                        <td>
                                            <div class="flex align-items-center list-user-action">
                                                <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="admin-add-category.html"><i class="ri-pencil-line"></i></a>
                                                <a class="bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->