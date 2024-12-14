<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Sujet</title>
    <link rel="stylesheet" type="text/css" href="/Edupath/css/addForm.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '/xampp/htdocs/EduPath/views/components/header.php'; ?>
    <main>
        <section class="form-section">
            <h1>Modifier Sujet</h1>
            <?php
                $id_sujet = isset($_GET['id']) ? $_GET['id'] : '';

                require_once '/xampp/htdocs/EduPath/controllers/sujetForumC.php';
                $sujetForumC = new sujetForumC();
                $sujet = $sujetForumC->getSujet($id_sujet);

                if (!$sujet) {
                    echo "<p>Sujet not found.</p>";
                    //exit();
                }
            ?>
            <form action="updateSujet.php?id=<?php echo $id_sujet ?>" method="post">
                <div id="error-message" style="color: red;"></div>
                <div class="form-group">
                    <label for="title">Titre:</label>
                    <input type="text" id="title" name="title" value="<?php echo $sujet['title']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required><?php echo $sujet['description']; ?></textarea>
                </div>

                <button type="submit">Modifier</button>
            </form>
        </section>
    </main>
</body>
</html>