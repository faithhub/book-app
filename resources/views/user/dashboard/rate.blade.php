@extends('vendor.layouts.app')
@section('vendor')
<!-- Page Content  -->

<style>
    * {
        margin: 0;
        padding: 0;
    }

    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        position: absolute;
        top: -9999px;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }

    button:disabled,
    button[disabled] {
        border: 1px solid #999999 !important;
        background-color: gray !important;
        color: black !important;
        font-weight: 600 !important;
        cursor: no-drop !important;
    }
</style>
<div class="modal fade" data-backdrop="static" id="viewMessageSent" tabindex="-1" role="dialog" aria-labelledby="viewMessageSentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
            </div> -->
            <div class="modal-body mt-3 mb-3">
                <div class="row align-items-center text-center">
                    <div class="form-group col-sm-12">
                        <form method="POST" action="{{ route('user.rate') }}">
                            @csrf
                            <h3 class="modal-title" id="viewMessageSentLabel">{{ $book_name }}</h3>
                            <div class="justify-content-center d-flex align-items-center" style="align-items: center!important;">
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" onclick="$('#submitButton').removeAttr('disabled',$('#star5').is(':checked'));" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" onclick="$('#submitButton').removeAttr('disabled',$('#star4').is(':checked'));" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" onclick="$('#submitButton').removeAttr('disabled',$('#star3').is(':checked'));" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" onclick="$('#submitButton').removeAttr('disabled',$('#star2').is(':checked'));" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" onclick="$('#submitButton').removeAttr('disabled',$('#star1').is(':checked'));" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                            </div>
                            <h5 class="modal-title" id="viewMessageSentLabel">Rate Material</h5>
                            <button type="submit" disabled id="submitButton" class="btn btn-primary mt-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
            </div> -->
        </div>
    </div>
</div>
<script type="text/javascript">
    $(window).on('load', function() {
        $('#viewMessageSent').modal('show');
    });
    // $('#checkbox-id').click(function() {
    //     if ($(this).is(':checked')) {
    //         $('#button-id').removeAttr('disabled');
    //     } else {
    //         $('#button-id').attr('disabled', 'disabled');
    //     }
    // });
    // var checker = document.getElementsByName('rate');
    // var sendbtn = document.getElementById('submit');
    // // when unchecked or checked, run the function
    // checker.onchange = function() {
    //     if (this.checked) {
    //         sendbtn.disabled = false;
    //     } else {
    //         sendbtn.disabled = true;
    //     }
    // }
</script>
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
        </div>
    </div>
</div>
@endsection