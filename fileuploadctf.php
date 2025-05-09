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
    ];

    if (!in_array($mimeType, $allowed_types)) {
        $message = "❌ Upload failed: Disallowed file type based on file header.";
    } elseif (!move_uploaded_file($tmpFile, $target_path)) {
        $message = "❌ Your file was not uploaded.";
    } else {
        $message = "✅ File uploaded successfully to <strong>{$target_path}</strong>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Beautiful File Uploader</title>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background: linear-gradient(to right, #2c3e50, #3498db);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .upload-container {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }

        .upload-container h2 {
            margin-bottom: 20px;
        }

        input[type="file"] {
            background: #fff;
            border: none;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            cursor: pointer;
        }

        input[type="submit"] {
            background-color: #27ae60;
            border: none;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #2ecc71;
        }

        .message {
            margin-top: 20px;
            font-weight: bold;
        }

        .message strong {
            color: #ffd700;
        }
    </style>
</head>
<body>
    <div class="upload-container">
        <h2>Upload Your Image</h2>
        <form enctype="multipart/form-data" action="" method="POST">
            <input type="file" name="uploaded" required><br>
            <input type="submit" name="Upload" value="Upload">
        </form>
        <?php if (isset($message)): ?>
            <div class="message"><?= $message ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
