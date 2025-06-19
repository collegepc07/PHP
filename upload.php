<?php
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = basename($file['name']);
    $fileTmpName = $file['tmp_name'];

    if (!is_dir('file_uploader')) {
        mkdir('file_uploader');
    }


    if (move_uploaded_file($fileTmpName, 'file_uploader/' . $fileName)) {
        echo "File uploaded successfully: " . $fileName;
    } else {
        echo "Failed to upload file.";
    }
}
?>
