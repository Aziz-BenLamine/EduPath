<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Réponse</title>
    <link rel="stylesheet" type="text/css" href="/Edupath/css/addForm.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <?php include '/xampp/htdocs/EduPath/views/components/header.php'; ?>
    <main>
        <section class="form-section">
            <h1>Modifier Réponse</h1>
            <?php
            $id_reponse = isset($_GET['id']) ? $_GET['id'] : '';

            require_once '/xampp/htdocs/EduPath/controllers/reponseC.php';
            $reponseC = new reponseC();
            $reponse = $reponseC->getReponse($id_reponse);

            if (!$reponse) {
                echo "<p>Réponse not found.</p>";
                //exit();
            }
            ?>
            <form action="updateReponse.php?id=<?php echo $id_reponse ?>" method="post">
                <div id="error-message" style="color: red;"></div>
                <div class="form-group">
                    <label for="contenu">Contenu:</label>
                    <textarea id="contenu" name="contenu" required><?php echo $reponse['contenu']; ?></textarea>
                </div>

                <button type="submit">Modifier</button>
            </form>
        </section>
    </main>
</body>

</html>