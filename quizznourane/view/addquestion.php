<?php
include __DIR__ . '/../model/quizModel.php';
include __DIR__ . '/../controleur/quizControler.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idq = $_POST['idq'];
    $questionText = $_POST['question'];
    $typeq = $_POST['typeq'];
    $id_quiz = $_POST['id_quiz'];
    $numR = $_POST['numR']; // Fetch the new attribute from POST data

    $question = new Question();
    $question->setIdq($idq);
    $question->setQuestion($questionText);
    $question->setTypeq($typeq);
    $question->setId_quiz($id_quiz);
    $question->setNumR($numR); // Set the new attribute

    $quizController = new quizs();

    $result = $quizController->addquestion($question);
    if ($result) {
        header('Location: index.php');
        exit;
    } else {
        $error = "Failed to add the question.";
    }
}

if (!empty($error)) {
    echo "<p style='color: red; text-align: center;'>$error</p>";
}
?>
