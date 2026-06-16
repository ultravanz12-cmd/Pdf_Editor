<!DOCTYPE html>
<html>
<head>
    <title>Adobe PDF Viewer</title>

    <script src="https://acrobatservices.adobe.com/view-sdk/viewer.js"></script>

    <style>
        html, body {
            margin: 0;
            height: 100%;
        }

        #adobe-dc-view {
            height: 100vh;
            width: 100%;
        }
    </style>
</head>

<body>

<div id="adobe-dc-view"></div>

<script>

document.addEventListener("adobe_dc_view_sdk.ready", function () {

    var adobeDCView = new AdobeDC.View({
        clientId: "e027ed1204fc4521b109bc7431b2b971",
        divId: "adobe-dc-view"
    });

    adobeDCView.previewFile({

        content: {
            location: {
                url: "{{ url('uploads/'.$file) }}"
            }
        },

        metaData: {
            fileName: "{{ $file }}"
        }

    }, {
        embedMode: "FULL_WINDOW",
        showDownloadPDF: true,
        showPrintPDF: true
    });

});

</script>

</body>
</html>