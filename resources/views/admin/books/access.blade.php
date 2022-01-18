@extends('admin.layouts.app')
@section('admin')
<style>
    .text-me {
        color: #6c757d;
        font-weight: 600;
    }

    .cloud-container {
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100vh;
    }
</style>
<!-- Page Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            @if($material_type == "Video")
            <video class="embed-responsive embed-responsive-1by1" loop controls muted>
                <source src="{{ $material }}" type="video/mp4" />
            </video>
            @elseif($material_type == "PDF")
            <div id="adobe-dc-view" class="cloud-container"></div>
            <script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
            <script type="text/javascript">
                document.addEventListener("adobe_dc_view_sdk.ready", function() {
                    var adobeDCView = new AdobeDC.View({
                        clientId: "{{ env('ADOBECLIENTID') }}",
                        divId: "adobe-dc-view"
                    });
                    adobeDCView.previewFile({
                        content: {
                            location: {
                                url: "{{ $material }}"
                            }
                        },
                        metaData: {
                            fileName: "{{ $title }}.pdf"
                        }
                    }, {
                        showAnnotationTools: false,
                        showDownloadPDF: false,
                        showPrintPDF: false
                    });
                });
            </script>
            @endif
        </div>
    </div>
</div>
@endsection