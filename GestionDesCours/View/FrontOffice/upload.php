<?php
require_once '../../Controller/pdfcontroller.php';
$pdfController = new PdfController();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pdf= new Pdf(
        1,
        $_POST['desc'],
        $_POST['File'],
        $_POST['courseid']
    );
    $pdfController->ajouterpdf($pdf);
    $idcat = $_GET['idcat'];
    //header('Location: courstuteur.php?id='.$idcat);
} else {
    echo "Erreur";
}
