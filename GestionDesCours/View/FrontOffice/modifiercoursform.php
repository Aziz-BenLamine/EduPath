<?php
require_once '../../Controller/categoriescontroller.php';
$CategoriesController = new CategoriesController();
$cat_id = $_GET['id'];
$currentCategory = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $currentCategory = $CategoriesController->getCategoriesById($id);
}
 require_once '../../Controller/courscontroller.php';
    $coursController = new CoursController();
    $cours = $coursController->affichercours($cat_id);
$currentcourse = null;
if (isset($_GET['idcours'])) {
    $id = $_GET['idcours'];
    $currentcourse = $coursController->getCoursById($id);
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
        <h2>Categorie: <?php echo $currentCategory['titre']?></h2>
        
        <div id="courses" class="courses-container">
        <?php foreach ($cours as $course) : ?>
        <div class="course">
            <h2><?php echo $course['titre']; ?></h2>
            <p><?php echo $course['description']; ?></p>
            <p><?php echo $course['niveau']; ?></p>
            <p><?php echo $course['prix']; ?> Dt</p>
            <p><?php echo $currentCategory['titre']; ?></p>
            <a class="blue-button" href="modifiercoursform.php?id=<?php echo $course['id'] ?>">Modifier</a>
            <a class="blue-button" href="supprimercours.php?id=<?php echo $course['id']?>">Supprimer</a>
        </div>
        
    <?php endforeach; ?>
        </div>

        <form class="form-container" id="editCourseForm" style="display: block;" action="modifiercours.php" method="post">
            <h2>Modifier un Cours</h2>
    <input type="number" id="courseId" name="courseId" value="<?php echo $currentcourse['id']?>" readonly >
            <input type="text" id="courseTitle" name="courseTitle" value="<?php echo $currentcourse['titre']?>" required>
    <input id="courseDescription" name="courseDescription" value="<?php echo $currentcourse['description']?>" required>
    <label for="courseLevel">Niveau :</label>
    <select id="courseLevel" name="courseLevel" required>
        <option value="<?php echo $currentcourse['niveau']?>" disabled selected><?php echo $currentcourse['niveau']?></option>
        <option value="Débutant">Débutant</option>
        <option value="Intermédiaire">Intermédiaire</option>
        <option value="Avancé">Avancé</option>
    </select>
    <input type="text" id="coursePrice" name="coursePrice" value="<?php echo $currentcourse['prix']?>" required>
    <input type="text" id="courseCategory" name="courseCategory" value="<?php echo $currentCategory['id']?>" readonly>
    
            <button type="submit">Enregistrer</button>
            <button type="button" onclick="cancelEdit()">Annuler</button>
        </form>

        <div style="text-align: center; margin-top: 20px;">
            <button class="blue-button" onclick="addNewCourse()">Ajouter un Nouveau Cours</button>
            <a class="blue-button" href="indextuteur.php">retour</a>
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

