<?php
include_once '../../Controller/courscontroller.php';
$courseController = new CoursController();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['courseId'];
    $titre = $_POST['courseTitle'];
    $description = $_POST['courseDescription'];
    $niveau = $_POST['courseLevel'];
    $prix = $_POST['coursePrice'];
    $categorie = $_POST['courseCategory'];
    $userid = $_GET['user'];
    
    $cours = new Cours($id, $titre, $description, $niveau, $prix, $categorie , $userid);
    $cours->setTitre($titre);
    $cours->setDescription($description);
    $cours->setNiveau($niveau);
    $cours->setPrix($prix);
    $cours->setCategorie($categorie);
    $cours->setUserId($userid);
    
    $courseController->modifiercours($cours, $id);
    header('Location: courstuteur.php?id='.$categorie .'&user='.$userid);
}