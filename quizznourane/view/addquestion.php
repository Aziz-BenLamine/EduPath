<?php
include '../../quizznourane/model/quizModel.php';
include '../../quizznourane/controleur/quizControler.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $idq = $_POST['idq'];
    $questionText = $_POST['question'];
    $typeq = $_POST['typeq'];}

    
    $question = new question();
    $question->setIdq($idq);
    $question->setQuestion($questionText);
    $question->setTypeq($typeq);

   
    $quizController = new quizs();

    
    $result = $quizController->addquestion($question);
    header('Location: index.html');


if (!empty($error)) {
    echo "<p style='color: red; text-align: center;'>$error</p>";
}
?>
