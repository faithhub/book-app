@extends('user.layouts.app')
@section('user')
<style>
    .text-me {
        color: #6c757d;
        font-weight: 600;
    }
    .cloud-container{
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    right:0;
    overflow:hidden;
    z-index:-1; /* Remove this line if it's not going to be a background! */
}
</style>
<!-- Page Content  -->
<div id="content-page" class="content-page">
    <div id="adobe-dc-view" class="cloud-container"></div>
    <script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
    <script type="text/javascript">
        document.addEventListener("adobe_dc_view_sdk.ready", function() {
            var adobeDCView = new AdobeDC.View({
                clientId: "347d68dea37d4e97a7040026d8f34ad3",
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
            }, {
                showDownloadPDF: false
            });
        });
    </script>
</div>
@endsection