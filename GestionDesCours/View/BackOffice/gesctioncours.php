<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPath|Admin</title>
    <link rel="stylesheet" href="ad.css">
</head>
<body>
<div class="sidebar">
        <div class="logo">
            <img src="logo.png" alt="Logo">
            <span>EduPath</span>
        </div>
        <a href="#" >Gestion des utilisateurs</a>
        <a href="indexadmin.php" >Gestion des categories</a>
        <a href="gesctioncours.php"class="active">Gestion des cours</a>
        <a href="#">Gestion des forums</a>
        <a href="#">Gestion des quizz</a>
        <a href="#">Gestion des reclamations</a>
    </div>
    <button class="toggle-btn" onclick="toggleSidebar()">&#9664;</button>
    <main>
        <h1>Gestion des Catégories</h1>
        
    
<div class="category-count-box">
    <?php
    require_once '../../Controller/courscontroller.php';
    $CoursController = new CoursController();
    $courseCount = $CoursController->getCoursCount();
    echo "<p style='color: blue; font-weight: bold;'>Nombre de catégories: " . $courseCount . "</p>";
    ?>
</div>
    <script src="script.js"></script>
    </main>

</body>
</html>

