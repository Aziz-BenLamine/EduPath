<?php
include __DIR__ . '/../model/quizModel.php';
include __DIR__ . '/../controleur/quizControler.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $categorie = $_POST['categorie'];
    $image = $_POST['image'];
}

    
    $Quiz = new Quiz();
    $Quiz->setId($id);
    $Quiz->setTitre($titre);
    $Quiz->setDescription($description);
    $Quiz->setCategorie($categorie);
    $Quiz->setImage($image);
   
    $quizController = new quizs();

    
    $result = $quizController->updatequiz($Quiz);
    //header('Location: index.php');


if (!empty($error)) {
    echo "<p style='color: red; text-align: center;'>$error</p>";
}
?>
