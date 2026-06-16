<!DOCTYPE html>
<html>

<head>

<title>PDF Editor</title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>

body{
margin:0;
padding:20px;
font-family:Arial;
}

.toolbar{
margin-bottom:20px;
}

canvas{
border:1px solid #ccc;
}

</style>

</head>

<body>

<div class="toolbar">

<button onclick="addText()">
Add Text
</button>

<button onclick="enableDraw()">
Draw
</button>

<button onclick="saveAnnotations()">
Save
</button>

</div>

<canvas id="pdf-canvas"></canvas>

<script>

const pdfUrl = "/uploads/{{ $file }}";

let fabricCanvas;

pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {

pdf.getPage(1).then(page => {

const scale = 1.5;

const viewport = page.getViewport({
scale
});

const canvas =
document.getElementById('pdf-canvas');

const context =
canvas.getContext('2d');

canvas.height = viewport.height;
canvas.width = viewport.width;

page.render({
canvasContext: context,
viewport: viewport
});

fabricCanvas =
new fabric.Canvas('pdf-canvas');

});

});

function addText()
{
const text =
new fabric.IText('Edit Me', {

left:100,
top:100

});

fabricCanvas.add(text);
}

function enableDraw()
{
fabricCanvas.isDrawingMode = true;
}

function saveAnnotations()
{
const data =
fabricCanvas.toJSON();

fetch('/save-annotations', {

method:'POST',

headers:{
'Content-Type':'application/json',
'X-CSRF-TOKEN':
document.querySelector(
'meta[name="csrf-token"]'
).content
},

body:JSON.stringify({

file:'{{ $file }}',
annotation:data

})

})

.then(r => r.json())
.then(data => {

alert('Saved');

});

}

</script>

</body>
</html>