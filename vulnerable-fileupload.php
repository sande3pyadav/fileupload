<?php

if (isset($_POST['Upload'])) {
    // Where are we going to be writing to?
    $uploadDir = "uploads/";
    $fileName = $_FILES['uploaded']['name'];
    $target_path = $uploadDir . $fileName;

    // Can we move the file to the upload folder?
    if (!move_uploaded_file($_FILES['uploaded']['tmp_name'], $target_path)) {
        // No
        echo '<pre>Your image was not uploaded.</pre>';
    } else {
        // Yes!
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
