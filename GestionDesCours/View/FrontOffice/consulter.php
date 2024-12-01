<?php
require_once '../../Controller/pdfcontroller.php';
$pdfController = new PdfController();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pdfs=$pdfController->afficherpdfs($id);
} else {
    echo "Erreur";
}
if ($pdfs) {
    // Définir les en-têtes pour afficher le PDF
    header('Content-Type: application/pdf');
    echo $file['description'];
} else {
    echo "Fichier non trouvé.";
}
?>
