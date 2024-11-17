<?php
include_once "/xampp/htdocs/EduPath/controllers/publicationC.php";
include_once "/xampp/htdocs/EduPath/controllers/sujetForumC.php";
include_once "/xampp/htdocs/EduPath/controllers/reponseC.php";

$publicationC = new publicationC();
$countP = $publicationC->countPublications();

$reponseC = new reponseC();
$countR = $reponseC->countReponses();

$sujetC = new sujetForumC();
$countS = $sujetC->countSujets();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Statistics</title>
    <link rel="stylesheet" type="text/css" href="/Edupath/css/stats.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '/xampp/htdocs/EduPath/views/components/header.php'; ?>
    <main>
        <section class="stats-section">
            <h1>Forum Statistics</h1>
            <div class="stats-container">
                <div class="stat-box">
                    <h2>Publications</h2>
                    <p><?php echo $countP; ?></p>
                </div>
                <div class="stat-box">
                    <h2>Responses</h2>
                    <p><?php echo $countR; ?></p>
                </div>
                <div class="stat-box">
                    <h2>Topics</h2>
                    <p><?php echo $countS; ?></p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>