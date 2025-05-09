<?php

if (isset($_POST['Upload'])) {
    $uploadDir = "uploads/";
    $fileName = $_FILES['uploaded']['name'];
    $tmpFile = $_FILES['uploaded']['tmp_name'];
    $target_path = $uploadDir . $fileName;

    // Get the browser-supplied Content-Type
    $contentType = $_FILES['uploaded']['type'];

    // Allowed Content-Types (browser-supplied)
    $allowed_types = [
        'image/jpeg',
        'image/png',
        'image/gif'
    ];

    if (!in_array($contentType, $allowed_types)) {
        echo '<pre>Upload failed: Disallowed content type.</pre>';
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
