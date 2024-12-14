<?php
include '../../controllers/réponsesC.php';

$reponseController = new ReponseC();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $reponseController->unhide($id);
    echo 'success';
    header('Location:listeRec.php');
} else {
    echo 'ID de réclamation non spécifié.';
}
?>