<!DOCTYPE html>
<html>
<head>
    <title>Visualizador de PDF</title>
    <script src="{{ asset('js/pdfjs/build/pdf.js') }}"></script>
</head>
<body>
<div id="viewer"></div>
<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const filename = '{{ $filename }}';
    const pdfFile = `{{ asset('assets/documents/') }}/${filename}`;

    const viewerContainer = document.getElementById('viewer');

    pdfjsLib.getDocument(pdfFile).promise.then(function(pdf) {
        for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
            pdf.getPage(pageNum).then(function(page) {
                const canvas = document.createElement('canvas');
                canvas.style.display = 'block';
                const context = canvas.getContext('2d');
                const viewport = page.getViewport({ scale: 1 });

                canvas.width = viewport.width;
                canvas.height = viewport.height;

                viewerContainer.appendChild(canvas);

                page.render({
                    canvasContext: context,
                    viewport: viewport
                });
            });
        }
    });
</script>
</body>
</html>
