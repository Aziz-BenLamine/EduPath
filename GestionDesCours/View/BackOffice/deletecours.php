<?php
require_once '../../Controller/courscontroller.php';


$courseController = new CoursController();

$cours=$courseController->getCoursById($_GET['id']);
$titre=$cours['titre'];
if (isset($_GET['id'])){
$id = $_GET['id'];
$courseController->supprimercours($id);


header('Location: gesctioncours.php');
}
else{
    echo "Erreur";
}