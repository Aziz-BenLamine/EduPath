<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPath|Admin</title>
    <link rel="stylesheet" href="a.css">
</head>
<body>
    <nav class="navbar">
        <img src="logo.png" alt="Logo" class="logo" height="40">
        <a href="#">Mon Profil</a>
        <a href="#">Accueil</a>
        <a href="#">Déconnexion</a>
    </nav>
    <nav class="sidebar">
        <ul>
            <li><a href="#">Gestion des Utilisateurs</a></li>
            <li class="active"><a href="#">Gestion des Catégories</a></li>
            <li><a href="#">Gestion des Cours</a></li>
        </ul>
    </nav>
    <main>
        <h1>Gestion des Catégories</h1>
        
        <div id="categories" class="categories-container" display="center">
            <?php
            require_once '../../Controller/categoriescontroller.php';
            $CategoriesController = new CategoriesController();
            $CategoriesController->affichercategories();
            ?>
        </div>
        
        <div style="text-align: left; margin-top: 20px;">
            <button class="blue-button" onclick="addNewCategory()">Ajouter une Nouvelle Catégorie</button>
            <button class="blue-button" onclick="showDeleteCategoryModal()">Supprimer une Catégorie</button>
            <button class="blue-button" onclick="showeditCategory()">Modifier une Catégorie</button>
        </div>
    </main>

    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <button class="close" onclick="closeModal()" onKeyDown="if(event.key === 'Enter' || event.key === ' ') closeModal()">&times;</button>
            
            <form class="form-container" id="categoryForm" method="post" action="ajoutercategories.php">
                <h2 id="formTitle">Ajouter une Catégorie</h2>
                <input type="text" id="categoryTitle" name="categoryTitle" placeholder="Nom de la catégorie" required>
                <textarea id="categoryDescription" name="categoryDescription" placeholder="Description de la catégorie" required></textarea>
                <button type="submit">Enregistrer</button>
                <button type="button" onclick="cancelEdit()">Annuler</button>
            </form>
        </div>
    </div>
    <div id="deleteCategoryModal" class="modal">
        <div class="modal-content">
            <button class="close" onclick="closeModal()" onKeyDown="if(event.key === 'Enter' || event.key === ' ') closeModal()">&times;</button>
            
            <form class="form-container" id="deleteCategoryForm" method="post" action="supprimercategorie.php">
                <h2 id="deleteFormTitle">Supprimer une Catégorie</h2>
                <input type="number" id="id" name="id" placeholder="id de la catégorie" required>
                <button type="submit">Supprimer</button>
                <button type="button" onclick="cancelDelete()">Annuler</button>
            </form>
        </div>
    </div>
    <div id="edit" class="modal">
                <div class="modal-content">
                    <button class="close" onclick="closeModal()" onKeyDown="if(event.key === 'Enter' || event.key === ' ') closeModal()">&times;</button>
                    
                    <form class="form-container" id="editCategoryForm" method="post" action="modifiercategorie.php">
                        <h2 id="editFormTitle">Modifier une Catégorie</h2>
                        <input type="number" id="id" name="id" placeholder="ID de la catégorie" required>
                        <input type="text" id="titre" name="titre" placeholder="Nom de la catégorie" required>
                        <textarea id="description" name="description" placeholder="Description de la catégorie" required></textarea>
                        <button type="submit">Enregistrer</button>
                        <button type="button" onclick="cancelEdit()">Annuler</button>
                    </form>
                </div>
            </div>

    <script src="script.js"></script>

</body>
</html>
