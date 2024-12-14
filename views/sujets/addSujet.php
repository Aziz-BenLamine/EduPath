<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Sujet</title>
    <link rel="stylesheet" type="text/css" href="/Edupath/css/addForm.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="/Edupath/js/formValidation.js"></script>
</head>
<body>
    <?php include '/xampp/htdocs/EduPath/views/components/header.php'; ?>
    <main>
        <section class="form-section">
            <h1>Nouveau Sujet</h1>
            <form action="submitSujet.php" method="post" onsubmit="return validateForm()">
                
                <div class="form-group">
                    <label for="title">Titre:</label>
                    <input type="text" id="title" name="title">
                    <div id="error-message-title" style="color: red;"></div>
                </div>
                
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description"></textarea>
                    <div id="error-message-description" style="color: red;"></div>
                </div>

                <button type="submit">Ajouter</button>
            </form>
        </section>
    </main>
</body>
</html>