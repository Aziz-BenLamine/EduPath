<?php
require_once '../../Controller/pdfcontroller.php';
$user=$_GET['user'];
// Ensure the uploads directory exists
if (!is_dir('uploads')) {
    mkdir('uploads', 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $courseId = $_POST['courseid'];
    $descFile = $_FILES['desc'];
    $courseFile = $_FILES['File'];

    // Check if files are uploaded
    if ($descFile['error'] == UPLOAD_ERR_OK && $courseFile['error'] == UPLOAD_ERR_OK) {
        $descFilePath = 'uploads/' . basename($descFile['name']);
        $courseFilePath = 'uploads/' . basename($courseFile['name']);

        // Move uploaded files to the uploads directory
        if (move_uploaded_file($descFile['tmp_name'], $descFilePath) && move_uploaded_file($courseFile['tmp_name'], $courseFilePath)) {
            // Save file paths to the database
            $pdfController = new PDFController();
            $pdf= new PDF(
                1,
                $descFilePath,
                $courseFilePath,
                $courseId
            );
            $idcay=$_GET['idcat'];
            $pdfController->ajouterpdf($pdf);
            echo "Files have been uploaded and saved successfully.";
            header('Location: courstuteur.php?id='.$idcay.'&user='.$user);
        } else {
            echo "Failed to move uploaded files.";
        }
    } else {
        echo "Error uploading files.";
    }
}
