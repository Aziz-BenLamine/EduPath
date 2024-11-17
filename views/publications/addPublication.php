<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Publication</title>
    <link rel="stylesheet" type="text/css" href="/Edupath/css/addForm.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '/xampp/htdocs/EduPath/views/components/header.php'; ?>
    <main>
        <section class="form-section">
            <h1>Nouvelle Publication</h1>
            <?php
                // Retrieve id_sujet from query string
                $id_sujet = isset($_GET['id_sujet']) ? $_GET['id_sujet'] : '';
            ?>
            <form action="submitPublication.php?id_sujet=<?php echo $id_sujet ?>" method="post">
                <div class="form-group">
                    <label for="title">Titre:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required></textarea>
                </div>

                <button type="submit">Ajouter</button>
            </form>
        </section>
    </main>
</body>
</html>