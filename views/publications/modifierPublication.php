<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Publication</title>
    <link rel="stylesheet" type="text/css" href="/Edupath/css/addForm.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '/xampp/htdocs/EduPath/views/components/header.php'; ?>
    <main>
        <section class="form-section">
            <h1>Modifier Publication</h1>
            <?php
                $id_publication = isset($_GET['id']) ? $_GET['id'] : '';
                $id_sujet = isset($_GET['id_sujet']) ? $_GET['id_sujet'] : '';

                require_once '/xampp/htdocs/EduPath/controllers/publicationC.php';
                $publicationC = new publicationC();
                $publication = $publicationC->getPublication($id_publication);

                if (!$publication) {
                    echo "<p>Publication not found.</p>";
                    exit();
                }
            ?>
            <form action="updatePublication.php?id=<?php echo $id_publication ?>&id_sujet=<?php echo $id_sujet ?>" method="post">
                <div id="error-message" style="color: red;"></div>
                <div class="form-group">
                    <label for="title">Titre:</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($publication['titre']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required><?php echo htmlspecialchars($publication['contenu']); ?></textarea>
                </div>

                <button type="submit">Modifier</button>
            </form>
        </section>
    </main>
</body>
</html>