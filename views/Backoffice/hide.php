<?php
include '../../controllers/réponseC.php';

$reponseController = new ReponseC();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    var_dump($id);
    $reponseController->hideRec($id);
    header('Location:listeRec.php');
    exit();
} else {
    echo "ID de réclamation non spécifié.";
}
?>