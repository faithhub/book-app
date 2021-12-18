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
</style>
<div class="modal fade" data-backdrop="static" id="viewMessageSent" tabindex="-1" role="dialog" aria-labelledby="viewMessageSentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
            </div> -->
            <div class="modal-body mt-3 mb-3">
                <div class="row align-items-center text-center">
                    <div class="form-group col-sm-12">
                        <form method="POST" action="">
                            <h3 class="modal-title" id="viewMessageSentLabel">Material Title</h3>
                            <div class="justify-content-center d-flex align-items-center" style="align-items: center!important;">
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                            </div>
                            <h5 class="modal-title" id="viewMessageSentLabel">Rating</h5>
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
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
</script>
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
        </div>
    </div>
</div>
@endsection