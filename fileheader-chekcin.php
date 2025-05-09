<?php

if (isset($_POST['Upload'])) {
    $uploadDir = "uploads/";
    $fileName = $_FILES['uploaded']['name'];
    $tmpFile = $_FILES['uploaded']['tmp_name'];
    $target_path = $uploadDir . $fileName;

    // Detect MIME type based on file header only (magic bytes)
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $tmpFile);
    finfo_close($finfo);

    // Allow only specific file types based on real file header
    $allowed_types = [
        'image/jpeg',
        'image/png',
        'image/gif'
        // Add more if needed, like 'application/pdf', etc.
    ];

    if (!in_array($mimeType, $allowed_types)) {
        echo '<pre>Upload failed: Disallowed file type based on file header.</pre>';
    } elseif (!move_uploaded_file($tmpFile, $target_path)) {
        echo '<pre>Your file was not uploaded.</pre>';
    } else {
        echo "<pre>{$target_path} successfully uploaded!</pre>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title>
</head>
<body>
    <h2>Upload File</h2>
    <form enctype="multipart/form-data" action="" method="POST">
        <input type="file" name="uploaded" />
        <input type="submit" name="Upload" value="Upload" />
    </form>
</body>
</html>
