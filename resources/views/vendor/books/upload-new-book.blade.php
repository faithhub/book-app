@extends('vendor.layouts.app')
@section('vendor')
<!-- Page Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!--Get the samples from https://www.adobe.com/go/pdfembedapi_samples-->
                <!-- <div id="adobe-dc-view"></div>
                <script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
                <script type="text/javascript">
                    document.addEventListener("adobe_dc_view_sdk.ready", function() {
                        var adobeDCView = new AdobeDC.View({
                            clientId: "<YOUR_CLIENT_ID>",
                            divId: "adobe-dc-view"
                        });
                        adobeDCView.previewFile({
                            content: {
                                location: {
                                    url: "https://documentcloud.adobe.com/view-sdk-demo/PDFs/Bodea Brochure.pdf"
                                }
                            },
                            metaData: {
                                fileName: "Bodea Brochure.pdf"
                            }
                        });
                    });
                </script> -->
                <div class="iq-edit-list-data">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="personal-information" role="tabpanel">

                            <div class="col-lg-8 offset-lg-2 mt-5">
                                <div class="iq-card" style="border-radius: 30px;">
                                    <div class="iq-card-header d-flex justify-content-between">
                                        <div class="iq-header-title">
                                            <h4 class="card-title">Upload New Book</h4>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <form method="POST" action="{{ route('vendor.upload.new.book') }}">
                                            @csrf
                                            <div class="row align-items-center">
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
                                                    <label for="cpass"><b>Title of Material:</b></label>
                                                    <input type="text" class="form-control" id="cpass" value="{{old('book_name')}}" name="book_name">
                                                    @error('book_name')
                                                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="cpass"><b>Year of Publish:</b></label>
                                                    <input type="number" class="form-control" id="cpass" value="{{old('book_name')}}" name="book_name">
                                                    @error('book_name')
                                                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-sm-12">
                                                    <label for="cpass"><b>Country of Publish:</b></label>
                                                    <select class="form-control" id="cpassk" name="country" id="exampleFormControlSelect1">
                                                        <option value="">Select a Country</option>
                                                        @if(isset($countries))
                                                        @foreach($countries as $cats)
                                                        <option value="{{$cats->country_label}}" {{ old('country') == $cats->id ? "selected" : '' }}>{{$cats->country_label}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    @error('book_name')
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
                                                        <option value="{{$cats->name}}" {{ old('book_cat') == $cats->id ? "selected" : '' }}>{{$cats->name}}</option>
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
                                                    <label for="cpassk"><b>Paid/Free</b></label>
                                                    <select class="form-control" id="cpassk" onchange="bookPrice(this.value)" name="book_price" id="exampleFormControlSelect1">
                                                        <option value="">Choose One</option>
                                                        <option value="Paid" {{ old('book_price') == 'Paid' ? "selected" : '' }}>Paid</option>
                                                        <option value="Free" {{ old('book_price') == 'Free' ? "selected" : '' }}>Free</option>
                                                    </select>
                                                    @error('book_cat')
                                                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-sm-6" id="PaidDiv1" style="display: none;">
                                                    <label for="cpass"><b>Price:</b></label>
                                                    <input type="number" class="form-control" id="cpass" value="{{old('book_price')}}" name="book_price">
                                                    @error('book_price')
                                                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-sm-6" id="PaidDiv2" style="display: none;">
                                                    <label for="cpass"><b>Rent Price Per Day:</b></label>
                                                    <input type="number" class="form-control" id="cpass" value="{{old('book_rent')}}" name="book_rent">
                                                    @error('book_rent')
                                                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="cpass"><b>Tag:</b></label>
                                                    <input type="text" class="form-control" id="cpass" value="{{old('tag')}}" name="tag">
                                                    @error('tag')
                                                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="cpassk"><b>Type of Material</b></label>
                                                    <select class="form-control" id="cpassk" name="book_cat" id="exampleFormControlSelect1">
                                                        <option value="">Select a Type</option>
                                                        @if(isset($materials))
                                                        @foreach($materials as $cats)
                                                        <option value="{{$cats->name}}" {{ old('book_cat') == $cats->id ? "selected" : '' }}>{{$cats->name}}</option>
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
                                                    <label for="cpassk"><b>Book Cover / Video Cover</b></label>
                                                    <select class="form-control" id="cpassk" onchange="coverType(this.value)" name="cover_type" id="exampleFormControlSelect1">
                                                        <option value="">Choose One</option>
                                                        <option value="Book Cover" {{ old('cover_type') == 'Book Cover' ? "selected" : '' }}>Book Cover</option>
                                                        <option value="Video Cover" {{ old('cover_type') == 'Video Cover' ? "selected" : '' }}>Video Cover</option>
                                                    </select>
                                                    @error('book_cat')
                                                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-sm-12" id="videoCover" style="display: none;">
                                                    <label for="cpass"><b>Video Cover:</b></label>
                                                    <div class="custom-file">
                                                        <input type="file" accept="video/*" name="video_cover" class="custom-file-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                    </div>
                                                    @error('video_cover')
                                                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-sm-12" id="bookCover" style="display: none;">
                                                    <label for="cpass"><b>Book Cover:</b></label>
                                                    <div class="custom-file">
                                                        <input type="file" accept="image/*" name="book_cover" class="custom-file-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                    </div>
                                                    @error('book_cover')
                                                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="cpass"><b>Book Material:</b></label>
                                                    <div class="custom-file">
                                                        <input type="file" accept="application/pdf" name="book_pdf" class="custom-file-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                    </div>
                                                    @error('book_pdf')
                                                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="npass"><b>Book Description:</b></label>
                                                    <textarea name="book_desc" id="npass" class="form-control">{{old('book_desc')}}</textarea>
                                                    @error('book_desc')
                                                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary mr-2">Upload</button>
                                            <button type="reset" class="btn iq-bg-danger">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function bookPrice(id) {
        switch (id) {
            case "Paid":
                document.getElementById('PaidDiv1').style.display = 'block';
                document.getElementById('PaidDiv2').style.display = 'block';
                break;

            case "Free":
                document.getElementById('PaidDiv1').style.display = 'none';
                document.getElementById('PaidDiv2').style.display = 'none';
                break;

            default:
                document.getElementById('PaidDiv1').style.display = 'none';
                document.getElementById('PaidDiv2').style.display = 'none';
                break;
        }
    }

    function coverType(id) {
        switch (id) {
            case "Book Cover":
                document.getElementById('bookCover').style.display = 'block';
                document.getElementById('videoCover').style.display = 'none';
                break;

            case "Video Cover":
                document.getElementById('videoCover').style.display = 'block';
                document.getElementById('bookCover').style.display = 'none';
                break;

            default:
                document.getElementById('videoCover').style.display = 'none';
                document.getElementById('bookCover').style.display = 'none';
                break;
        }

    }
    $(document).ready(function() {
        //to disable the entire page
        // $("body").on("contextmenu", function(e) {
        //     return false;
        // });

        // //to disable a section
        // $('body').bind('cut copy paste', function(e) {
        //     e.preventDefault();
        // });
    });
</script>
@endsection