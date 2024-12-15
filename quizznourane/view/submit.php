<?php
session_start();
require_once '/xampp/htdocs/EduPath/quizznourane/controleur/quizControler.php';

$quizController = new quizs();
$questions = $quizController->affichequestion();
$reponses = $quizController->afficherReponse();

$score = 0;
$totalQuestions = count($questions);

foreach ($questions as $index => $question) {
    $questionId = $question['idq'];
    $correctAnswer = null;

    // Find the correct answer for the current question
    foreach ($reponses as $reponse) {
        if ($reponse['id_question'] == $questionId && $reponse['score'] > 0) {
            $correctAnswer = $reponse['id'];
            break;
        }
    }

    // Check if the submitted answer is correct
    if (isset($_POST['q' . $index]) && $_POST['q' . $index] == $correctAnswer) {
        $score++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link rel="stylesheet" href="/EduPath/views/css/style.css">
</head>

<body>
    <?php include '/xampp/htdocs/EduPath/views/components/header.php'; ?>

    <main>
        <section class="text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Quiz Results</h1>
                    <p class="lead text-muted">You scored <?= $score ?> out of <?= $totalQuestions ?>.</p>
                </div>
            </div>
        </section>
    </main>

</body>

</html>