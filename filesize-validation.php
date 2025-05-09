<?php

if (isset($_POST['Upload'])) {
    $uploadDir = "uploads/";
    $fileName = $_FILES['uploaded']['name'];
    $tmpFile = $_FILES['uploaded']['tmp_name'];
    $fileSize = $_FILES['uploaded']['size'];
    $target_path = $uploadDir . $fileName;

    // Maximum file size (in bytes) – e.g., 2MB
    $maxSize = 2 * 1024 * 1024;

    if ($fileSize > $maxSize) {
        echo '<pre>Upload failed: File size exceeds 2MB limit.</pre>';
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
