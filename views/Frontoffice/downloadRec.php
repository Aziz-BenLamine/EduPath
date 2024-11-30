<?php
include '../../controllers/réclamationC.php';

$reclamationController = new ReclamationC();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $reclamation = $reclamationController->afficherReclamation($id);

    if ($reclamation) {
        $filename = "reclamation_" . $reclamation['id'] . ".txt";
        $content = "ID: " . $reclamation['id'] . "\n";
        $content .= "Nom: " . $reclamation['nom'] . "\n";
        $content .= "Date: " . $reclamation['date_c'] . "\n";
        $content .= "Email: " . $reclamation['email'] . "\n";
        $content .= "Sujet: " . $reclamation['sujet'] . "\n";
        $content .= "Description: " . $reclamation['descript'] . "\n";
        $content .= "Téléphone: " . $reclamation['tel'] . "\n";

        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        echo $content;
        exit();
    } else {
        echo "Réclamation non trouvée.";
    }
} else {
    echo "ID de réclamation non spécifié.";
}
?>