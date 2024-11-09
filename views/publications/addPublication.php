<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Publication</title>
    <link rel="stylesheet" type="text/css" href="./css/forum_home.css">
</head>
<body>
    <header>
        <img src="views/sujets/logoBG.png" alt="EduPathLogo">
        <nav>
            <ul>
                <!-- TAF INTEGRATION-->
                <li><a href="?page=">Home</a></li>
                <li><a href="?page=home">Forum</a></li>
            </ul>
        </nav>
    </header>
    <h1>Nouvelle Publication</h1>
    <form action="submitPublication.php" method="post">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>