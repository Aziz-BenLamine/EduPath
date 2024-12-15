<?php
include __DIR__ . '/../model/quizModel.php';
include __DIR__ . '/../controleur/quizControler.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    

    $id = $_POST['id'];
    $reponseText = $_POST['reponse'];
    $score = $_POST['score'];
    $correction = $_POST['correction'];}
    $id_question = $_POST['id_question'];
    
    $reponse = new Reponse();
    $reponse->setReponseText($reponseText);
    $reponse->setScore($score);
    $reponse->setCorrection($correction);
    $reponse->setId_question($id_question);
    
    $quizController = new quizs();

    
    $result = $quizController->updateReponse($reponse , $id);
    header('Location: index.php');


if (!empty($error)) {
    echo "<p style='color: red; text-align: center;'>$error</p>";
}
?>
