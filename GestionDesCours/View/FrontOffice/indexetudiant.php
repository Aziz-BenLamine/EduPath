<?php
require_once '../../Controller/categoriescontroller.php';
$CategoriesController = new CategoriesController();
$categories = $CategoriesController->affichercategories();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPath|Etudiant</title>
    <link rel="stylesheet" href="e.css">



</head>
<body>
<header class="header">
    <a href="#" class="logo">
      <img src="/Edupath-main/views/components/EduPathLogo.png" alt="CheminÉdu Logo">
      <span>EduPath</span>
    </a>
    <nav class="nav">
      <a href="#" class="btn-primary">Cours</a>
      <a href="#">Quiz</a>
      <a href="#">Forum</a>
      <a href="#">Tuteurs</a>
      <a href="#">Reclamation</a>
      <a href="#" >Mon Compte</a>
    </nav>
  </header>
    <main>
        <h1>Liste des Categories</h1>
        <div id="courses" class="courses-container">
        <?php foreach ($categories as $categorie) : ?>
        <div class="course">
            <h2><?php echo $categorie['titre']; ?></h2>
            <p><?php echo $categorie['description']; ?></p>
            <a class="blue-button" href="coursetudiant.php?id=<?php echo $categorie['id'] ?>">afficher les cours</a>
        </div>
        <?php endforeach; ?>
    </main>
  <script src="script.js"></script>
  <!-- Footer -->
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
