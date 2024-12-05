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
    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        if ($sort == 'asc') {
            usort($cours, function ($a, $b) {
                return $a['prix'] - $b['prix'];
            });
        } elseif ($sort == 'desc') {
            usort($cours, function ($a, $b) {
                return $b['prix'] - $a['prix'];
            });
        }
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
        <form method="get" action="" style="margin-bottom: 20px; text-align: center; color: #000;">
            <label for="sort">Trier par prix :</label>
            <select name="sort" id="sort" onchange="this.form.submit()" style="margin-left: 10px; padding: 5px; background-color: #007BFF; color: #fff; border: none; border-radius: 4px;">
                <option value="">-- Sélectionnez --</option>
                <option value="asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'asc') echo 'selected'; ?>>Ascendant</option>
                <option value="desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'desc') echo 'selected'; ?>>Descendant</option>
            </select>
            <input type="hidden" name="id" value="<?php echo $cat_id; ?>">
        </form>
        
        <div id="courses" class="courses-container">
        <?php foreach ($cours as $course) : ?>
        <div class="course">
            <h2><?php echo $course['titre']; ?></h2>
            <p><?php echo $course['description']; ?></p>
            <p><?php echo $course['niveau']; ?></p>
            <p><?php echo $course['prix']; ?> Dt</p>
            <p><?php echo $currentCategory['titre']; ?></p>
            <a class="blue-button" href="ajouterpdf.php?id=<?php echo $course['id']?>&idcat=<?php echo $course['categorie'] ?>">Ajouter PDF</a>
            <a class="blue-button" href="modifiercoursform.php?id=<?php echo $course['categorie'] ?>&idcours=<?php echo $course['id']?>">Modifier</a>
            <a class="blue-button" href="supprimercours.php?id=<?php echo $course['id']?>">Supprimer</a>
        </div>
        
    <?php endforeach; ?>
        </div>

        <form class="form-container" id="courseForm" style="display: none;" action="ajoutercours.php" method="post">
    <h2 id="formTitle">Ajouter un Cours</h2>
    <input type="text" id="courseTitle" name="courseTitle" placeholder="Titre du cours" >
    <textarea id="courseDescription" name="courseDescription" placeholder="Description du cours" ></textarea>
    <label for="courseLevel">Niveau :</label>
    <select id="courseLevel" name="courseLevel" >
        <option value="" disabled selected>-- Sélectionnez un niveau --</option>
        <option value="Débutant">Débutant</option>
        <option value="Intermédiaire">Intermédiaire</option>
        <option value="Avancé">Avancé</option>
    </select>
    <input type="text" id="coursePrice" name="coursePrice" placeholder="Prix (ex: Gratuit, 50Dt)" >
    <input type="text" id="courseCategory" name="courseCategory" value="<?php echo $currentCategory['id']?>" readonly>
    <button type="submit">Enregistrer</button>
    <button type="button" onclick="cancelAdd()">Annuler</button>
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
  <script>
        

    function validateForm() {
        const title = document.getElementById('courseTitle').value.trim();
        const description = document.getElementById('courseDescription').value.trim();
        const level = document.getElementById('courseLevel').value;
        const price = document.getElementById('coursePrice').value.trim();

        if (title === '') {
            alert('Le titre du cours est requis.');
            return false;
        }

        if (/\d/.test(title)) {
            alert('Le titre du cours ne doit pas contenir de chiffres.');
            return false;
        }

        if (description === '') {
            alert('La description du cours est requise.');
            return false;
        }

        if (level === '') {
            alert('Le niveau du cours est requis.');
            return false;
        }

        if (price === '' || isNaN(price) || parseFloat(price) <= 0) {
            alert('Le prix du cours doit être un nombre positif.');
            return false;
        }

        return true;
    }

    document.getElementById("courseForm").onsubmit = validateForm;

    </script>
</body>
</html>
