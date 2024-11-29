<?php
require_once '../../Controller/courscontroller.php';
$CoursController = new CoursController();
$coursList = $CoursController->getAllCours();
require_once '../../Controller/categoriescontroller.php';
$CategoriesController = new CategoriesController();
$categories = $CategoriesController->getAllCategories();
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $coursList = $CoursController->searchCours($search);
} else {
    $coursList = $CoursController->getAllCours();
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPath|Admin</title>
    <link rel="stylesheet" href="ad.css">
    <style>
        input[type="text"] {
    padding: 10px;
    width: 300px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

button[type="submit"] {
    padding: 10px 20px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}
</style>
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
        <h1>Gestion des Cours</h1>
        <div style="margin-bottom: 20px; text-align: center; color: #000;">
        <form method="GET" >
    <input type="text" name="search" placeholder="Rechercher un cours">
    <button type="submit">Rechercher</button>
</form>
</div>

        
    <table border="1">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Niveau</th>
                <th>Prix</th>
                <th>Categorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($coursList as $course) :
            $id =$course['categorie'];
            $category= $CategoriesController->getCategoriesById($id);?>
                <tr>
                <td><?php echo $course['titre']; ?></td>
                <td><?php echo $course['description']; ?></td>
                <td><?php echo $course['niveau']; ?></td>
                <td><?php echo $course['prix']; ?></td>
                <td><?php echo $category['titre']; ?></td>
                <td><a class="blue-button" href="deletecours.php?id=<?php echo $course['id']; ?>">supprimer</a></td>
                </tr>
                
            <?php endforeach; ?>
        </tbody>
    </table>
<div class="category-count-box">
    <?php
    require_once '../../Controller/courscontroller.php';
    $CoursController = new CoursController();
    $courseCount = $CoursController->getCoursCount();
    echo "<p style='color: blue; font-weight: bold;'>Nombre de cours: " . $courseCount . "</p>";
    ?>
</div>
    <script src="script.js"></script>
    </main>

</body>
</html>
