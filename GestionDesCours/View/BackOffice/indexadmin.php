<?php
include_once '../../Controller/categoriescontroller.php';
include_once '../../Model/categories.php';
$CategoriesController = new CategoriesController();
$categories = $CategoriesController->affichercategories();
$currentCategory = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $currentCategory = $CategoriesController->getCategoriesById($id);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPath|Admin</title>
    <link rel="stylesheet" href="ad.css">
</head>

<body>

    <?php include 'C:\xampp\htdocs\EduPath\views/components/sidebar.php'; ?>
    <button class="toggle-btn" onclick="toggleSidebar()">&#9664;</button>
    <main>
        <h1>Gestion des Catégories</h1>

        <div id="categories" class="categories-container" display="center">
            <?php foreach ($categories as $categorie) : ?>
                <div class="category">
                    <h2><?php echo $categorie['titre']; ?></h2>
                    <p><?php echo $categorie['description']; ?></p>
                    <a class="blue-button" href="test.php?id=<?php echo $categorie['id'] ?>">Modifier<a>
                            <a class="blue-button" href="supprimercategorie.php?id=<?php echo $categorie['id'] ?>">Supprimer</a>
                            <div id="edit" class="modal">
                                <div class="modal-content">
                                    <button class="close" onclick="cancelEdit()" onKeyDown="if(event.key === 'Enter' || event.key === ' ') cancelEdit()">&times;</button>

                                    <!-- <form class="form-container" id="editCategoryForm" method="post" action="modifiercategorie.php">
                        <h2 id="editFormTitle">Modifier une Catégorie</h2>
                        <input type="number" id="id" name="id" value="<?php echo $categorie['id'] ?>" readonly >
                        <input type="text" id="titre" name="titre" value="<?php echo $categorie['titre'] ?>" >
                        <input id="description" name="description" value="<?php echo $categorie['description'] ?>" >
                        <button type="submit" class="blue-button">Enregistrer</button>
                        <button type="button" class="blue-button" onclick="cancelEdit()">Annuler</button>
                    </form>-->
                                </div>
                            </div>
                </div>

            <?php endforeach; ?>
        </div>

        <div style="text-align: left; margin-top: 20px;">
            <button class="blue-button" onclick="addNewCategory()">Ajouter une Nouvelle Catégorie</button>

        </div>
    </main>

    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <button class="close" onclick="closeModal()" onKeyDown="if(event.key === 'Enter' || event.key === ' ') closeModal()">&times;</button>

            <form class="form-container" id="categoryForm" method="post" action="ajoutercategories.php">
                <h2 id="formTitle">Ajouter une Catégorie</h2>
                <input type="text" id="categoryTitle" name="categoryTitle" placeholder="Nom de la catégorie">
                <textarea id="categoryDescription" name="categoryDescription" placeholder="Description de la catégorie"></textarea>
                <button type="submit" class="blue-button">Enregistrer</button>
                <button type="button" class="blue-button" onclick="cancelEdit()">Annuler</button>
            </form>
        </div>
    </div>


    <div class="category-count-box">
        <?php
        require_once '../../Controller/categoriescontroller.php';
        $CategoriesController = new CategoriesController();
        $categoryCount = $CategoriesController->getCategoryCount();
        echo "<p style='color: blue; font-weight: bold;'>Nombre de catégories: " . $categoryCount . "</p>";
        ?>
    </div>
    <script src="script.js"></script>

</body>

</html>