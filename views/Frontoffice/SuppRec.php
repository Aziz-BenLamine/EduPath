<?php
include '../../controllers/réclamationC.php';

$reclamationController = new ReclamationC();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $reclamationController->supprimerReclamation($id);
    header('Location:Reclist.php');
    exit();
} else {
    echo "ID de réclamation non spécifié.";
}
