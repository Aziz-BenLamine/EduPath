
<?php
include __DIR__ . '/../model/quizModel.php';
include __DIR__ . '/../controleur/quizControler.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $idq = $_POST['idq'];
    $questionText = $_POST['question'];
    $typeq = $_POST['typeq'];}
    $id_quiz = $_POST['id_quiz'];
    
    $question = new Question();
    $question->setIdq($idq);
    $question->setQuestion($questionText);
    $question->setTypeq($typeq);
    $question->setId_quiz($id_quiz);
   
    $quizController = new quizs();

    
    $result = $quizController->updatequestion($question , $idq);
    header('Location: index.php');


if (!empty($error)) {
    echo "<p style='color: red; text-align: center;'>$error</p>";
}
?>
