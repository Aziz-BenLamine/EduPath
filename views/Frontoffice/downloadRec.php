<?php
require '../../pdf/fpdf.php'; // Assurez-vous que le chemin est correct pour inclure l'autoloader de Composer
include '../../controllers/réclamationC.php';

// use FPDF\FPDF; // This line is not needed as FPDF does not use namespaces

$reclamationController = new ReclamationC();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $reclamation = $reclamationController->afficherReclamation($id);

    if ($reclamation) {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        $pdf->Cell(0, 10, 'Details de la Reclamation', 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'ID: ' . $reclamation['id'], 0, 1);
        $pdf->Cell(0, 10, 'Nom: ' . $reclamation['nom'], 0, 1);
        $pdf->Cell(0, 10, 'Date: ' . $reclamation['date_c'], 0, 1);
        $pdf->Cell(0, 10, 'Email: ' . $reclamation['email'], 0, 1);
        $pdf->Cell(0, 10, 'Sujet: ' . $reclamation['sujet'], 0, 1);
        $pdf->Cell(0, 10, 'Description: ' . $reclamation['descript'], 0, 1);
        $pdf->Cell(0, 10, utf8_decode('Téléphone: ') . $reclamation['tel'], 0, 1);

        $filename = "reclamation_" . $reclamation['id'] . ".pdf";
        $pdf->Output('D', $filename);
        exit();
    } else {
        echo "Réclamation non trouvée.";
    }
} else {
    echo "ID de réclamation non spécifié.";
}
?>