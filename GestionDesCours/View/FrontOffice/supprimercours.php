<?php
require_once '../../Controller/courscontroller.php';
$courseController = new CoursController();

$cours=$courseController->getCoursById($_GET['id']);
if (isset($_GET['id'])){
$id = $_GET['id'];
$courseController->supprimercours($id);
header('Location: courstuteur.php?id=' . $cours['categorie']);
}
else{
    echo "Erreur";
}