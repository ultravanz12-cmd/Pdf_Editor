<!DOCTYPE html>
<html>
<head>
    <title>Upload PDF</title>
</head>
<body>

<h2>Upload PDF</h2>

<form action="{{ route('upload') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <input type="file" name="pdf" accept=".pdf" required>

    <button type="submit">Upload</button>

</form>

</body>
</html>