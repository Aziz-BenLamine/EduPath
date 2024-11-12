<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Publication</title>
    <link rel="stylesheet" type="text/css" href="./css/addForm.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo-name">
            <img src="views/sujets/logoBG.png" alt="EduPathLogo">
            <h3>EduPath</h3>
        </div>
        <nav>
            <ul>
                <li><a href="?page=home">Home</a></li>
                <li><a href="?page=forum">Forum</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section class="form-section">
            <h1>Nouvelle Publication</h1>
            <form action="submitPublication.php" method="post">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description"  required></textarea>
                </div>
                
                <div class="form-group">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </section>
    </main>

</body>
</html>
