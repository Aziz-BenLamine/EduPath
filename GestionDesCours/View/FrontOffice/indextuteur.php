<?php
require_once '../../Controller/categoriescontroller.php';
$CategoriesController = new CategoriesController();
$categories = $CategoriesController->affichercategories();
if (isset($_GET['user'])) {
    $user = $_GET['user'];
}
else{
    $user = 1;
}
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $categories = $CategoriesController->searchCategories($search);
} else {
    $categories = $CategoriesController->affichercategories();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPath|Tuteur</title>
    <link rel="stylesheet" href="t.css">

</head>
<body>
<header class="header">
    <a href="#" class="logo">
      <img src="/Edupath-main/views/components/EduPathLogo.png" alt="CheminÉdu Logo">
      <span>EduPath</span>
    </a>
    <nav class="nav">
      <a href="#" class="btn-primary">Mes Cours</a>
      <a href="#">Mes Quiz</a>
      <a href="#">Forum</a>
      <a href="#">Reclamation</a>
      <a href="#" >Mon Compte</a>
    </nav>
  </header>
    <main>
        <h1>Gestion de Mes Cours</h1>
        <div style="margin-bottom: 20px; text-align: center; color: #000;">
        <form method="GET" >
    <input type="text" name="search" placeholder="Rechercher une catégorie">
    <button type="submit">Rechercher</button>
    
</form>
</div>
        
        <div id="courses" class="courses-container">
        <?php foreach ($categories as $categorie) : ?>
        <div class="course">
            <h2><?php echo $categorie['titre']; ?></h2>
            <p><?php echo $categorie['description']; ?></p>
            <a class="blue-button" href="courstuteur.php?id=<?php echo $categorie['id'] ?>&user=<?php echo $user?>">afficher mes cours</a>
            
            
        </div>
        
    <?php endforeach; ?>
        </div>
    </main>

    <script src="scripttu.js"></script>
    <footer class="footer">
      <div class="footer-content">
          <div class="footer-section">
              <h4>À propos</h4>
              <ul>
                  <li><a href="#">Qui sommes-nous ?</a></li>
                  <li><a href="#">Notre histoire</a></li>
                  <li><a href="#">Pourquoi Edupath ?</a></li>
              </ul>
          </div>
          <div class="footer-section">
              <h4>Support</h4>
              <ul>
                  <li><a href="#">Contactez-nous</a></li>
                  <li><a href="#">FAQ</a></li>
                  <li><a href="#">Reclamation</a></li>
              </ul>
          </div>
          <div class="footer-section">
              <h4>Produits</h4>
              <ul>
                  <li><a href="#">Quiz</a></li>
                  <li><a href="#">Cours</a></li>
                  <li><a href="#">Forum</a></li>
              </ul>
          </div>
          <div class="footer-section">
              <h4>Newsletter</h4>
              <form>
                  <input type="email" placeholder="Entrez votre email">
                  <button type="submit">S'abonner</button>
              </form>
          </div>
      </div>
      <p>© 2024 Edupath. Tous droits réservés.</p>
  </footer>
</body>
</html>


