var viewerConfig = {
    embedMode: "IN_LINE",
    showAnnotationTools: false,
    enableFormFilling: false,
    showLeftHandPanel: false,
    showDownloadPDF: true,
    showPrintPDF: true,
    showPageControls: true,
    dockPageControls: true,
    defaultViewMode: "FIT_WIDTH", /* Allowed possible values are "FIT_PAGE", "FIT_WIDTH" or "". */
};

/* Wait for Adobe Document Cloud View SDK to be ready */
document.addEventListener("adobe_dc_view_sdk.ready", function () {
    /* Initialize the AdobeDC View object */
    var adobeDCView = new AdobeDC.View({
        /* Pass your registered client id */
        clientId: "e8a165a7066d44048c3a05d48a13e800",
        /* Pass the div id in which PDF should be rendered */
        divId: "adobe-dc-view",
    });

    /* Invoke the file preview API on Adobe DC View object */
    adobeDCView.previewFile({
        /* Pass information on how to access the file */
        content: {
            /* Location of file where it is hosted */
            location: {
                url: "https://andrewburt.dev/projects/CSUBAR/files/Poster.pdf",
                /*
                If the file URL requires some additional headers, then it can be passed as follows:-
                headers: [
                    {
                        key: "<HEADER_KEY>",
                        value: "<HEADER_VALUE>",
                    }
                ]
                */
            },
        },
        /* Pass meta data of file */
        metaData: {
            /* file name */
            fileName: "Poster.pdf"
        }
    }, viewerConfig);
});

