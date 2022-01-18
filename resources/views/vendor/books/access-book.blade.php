@extends('vendor.layouts.app')
@section('vendor')
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
            <!-- <div id="e
            View"></div> -->
            <div id="embeddedView" class="cloud-container"></div>

            <!-- <img src="{{ $material }}" width="800px" height="2100px" />
            <embed src="{{ $material }}" width="800px" height="2100px" /> -->
            <!-- <script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
            <script type="text/javascript">
                apis.enableTextSelection(false);
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
            </script> -->
            <script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
            <script type="text/javascript">
                // Add ?page=4 to the end of the URL
                const urlToPDF =
                    "https://documentcloud.adobe.com/view-sdk-demo/PDFs/{{ $material }}";
                const clientId = "{{ env('ADOBECLIENTID') }}";
                const viewerOptions = {
                    embedMode: "FULL_WINDOW",
                    defaultViewMode: "FIT_WINDOW",
                    showDownloadPDF: false,
                    showPrintPDF: false,
                    showLeftHandPanel: true,
                    showAnnotationTools: false
                };

                function fetchPDF(urlToPDF) {
                    return new Promise((resolve) => {
                        fetch(urlToPDF)
                            .then((resolve) => resolve.blob())
                            .then((blob) => {
                                resolve(blob.arrayBuffer());
                            });
                    });
                }

                function goToPage(previewFilePromise, pageNum) {
                    previewFilePromise.then((adobeViewer) => {
                        adobeViewer.getAPIs().then((apis) => {
                            // Go to the page. Page numbers are 1 based.
                            apis.gotoLocation(parseInt(page));
                            apis.enableTextSelection(false);
                            apis.gotoLocation(parseInt(page));
                        });
                    });
                }


                function processEvent(event, previewFilePromise) {
                    if (event.type == "PDF_VIEWER_OPEN") {
                        // Get the page parameter from the URL
                        const queryString = window.location.search;
                        const urlParams = new URLSearchParams(queryString);
                        const pageNum = urlParams.get("page");
                        // Go to the page number specified in the URL
                        goToPage(previewFilePromise, pageNum);
                    }
                }

                document.addEventListener("adobe_dc_view_sdk.ready", function() {
                    // Create embedded view
                    var adobeDCView = new AdobeDC.View({
                        clientId: clientId,
                        divId: "embeddedView"
                    });
                    // Show the file

                    var previewFilePromise = adobeDCView.previewFile({
                            content: {
                                promise: fetchPDF(urlToPDF)
                            },
                            metaData: {
                                fileName: urlToPDF.split("/").slice(-1)[0]
                            }
                        },
                        viewerOptions
                    );
                    // create object to set events that we want to listen for
                    var eventOptions = {
                        listenOn: [AdobeDC.View.Enum.Events.PDF_VIEWER_OPEN],
                        enableFilePreviewEvents: true
                    };
                    // register the event callback
                    adobeDCView.registerCallback(
                        AdobeDC.View.Enum.CallbackType.EVENT_LISTENER,
                        function(event) {
                            processEvent(event, previewFilePromise);
                        },
                        eventOptions
                    );
                });



                // Helper Function: Add arrayBuffer if necessary i.e. Safari
                (function() {
                    if (Blob.arrayBuffer != "function") {
                        Blob.prototype.arrayBuffer = myArrayBuffer;
                    }

                    function myArrayBuffer() {
                        return new Promise((resolve) => {
                            let fileReader = new FileReader();
                            fileReader.onload = () => {
                                resolve(fileReader.result);
                            };
                            fileReader.readAsArrayBuffer(this);
                        });
                    }
                })();
            </script>
            @endif
        </div>
    </div>
</div>
@endsection