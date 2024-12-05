<?php
require_once '../../Controller/pdfcontroller.php';

$pdfController = new PdfController();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pdfs = $pdfController->getpdfbycours($id);
    var_dump($pdfs);

    if ($pdfs && !empty($pdfs[0]['description'])) {
        $filePath = $pdfs[0]['description']; 

        if (file_exists($filePath)) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');

            readfile($filePath);
            exit;
        } else {
            echo "Erreur: Le fichier n'existe pas.";
        }
    } else {
        echo "Fichier non trouvé.";
    }
} else {
    echo "Erreur: ID manquant.";
}
?>
