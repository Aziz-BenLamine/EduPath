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
        
        <div id="courses" class="courses-container">
            <?php
            require_once '../../Controller/courscontroller.php';
            $CoursController = new CoursController();
            $CoursController->affichercours();
            ?>
        </div>

        <form class="form-container" id="courseForm" style="display: none;" action="ajoutercours.php" method="post">
            <h2 id="formTitle">Ajouter un Cours</h2>
            <input type="text" id="courseTitle" name="courseTitle" placeholder="Titre du cours" required>
            <textarea id="courseDescription" name="courseDescription" placeholder="Description du cours" required></textarea>
            <input type="text" id="courseLevel" name="courseLevel" placeholder="Niveau (Débutant, Intermédiaire, Avancé)" required>
            <input type="text" id="coursePrice" name="coursePrice" placeholder="Prix (ex: Gratuit, 50Dt)" required>
            <input type="text" id="courseCategory" name="courseCategory" placeholder="Catégorie du cours" required>
            <button type="submit">Enregistrer</button>
            <button type="button" onclick="cancelAdd()">Annuler</button>
        </form>
        <form class="form-container" id="deleteCourseForm" style="display: none;" action="supprimercours.php" method="post">
            <h2>Supprimer un Cours</h2>
            <input type="text" id="deleteCourseId" name="courseId" placeholder="ID du cours" required>
            <button type="submit">Supprimer</button>
            <button type="button" onclick="cancelDelete()">Annuler</button>
        </form>

        <form class="form-container" id="editCourseForm" style="display: none;" action="modifiercours.php" method="post">
            <h2>Modifier un Cours</h2>
            <input type="text" id="editCourseId" name="courseId" placeholder="ID du cours" required>
            <input type="text" id="editCourseTitle" name="courseTitle" placeholder="Titre du cours" required>
            <textarea id="editCourseDescription" name="courseDescription" placeholder="Description du cours" required></textarea>
            <input type="text" id="editCourseLevel" name="courseLevel" placeholder="Niveau (Débutant, Intermédiaire, Avancé)" required>
            <input type="text" id="editCoursePrice" name="coursePrice" placeholder="Prix (ex: Gratuit, 50Dt)" required>
            <input type="text" id="editCourseCategory" name="courseCategory" placeholder="Catégorie du cours" required>
            <button type="submit">Enregistrer</button>
            <button type="button" onclick="cancelEdit()">Annuler</button>
        </form>

        <div style="text-align: center; margin-top: 20px;">
            <button class="blue-button" onclick="addNewCourse()">Ajouter un Nouveau Cours</button>
            <button class="blue-button" onclick="showDeleteCourseModal()">Supprimer un Cours</button>
            <button class="blue-button" onclick="showEditCourse()">Modifier un Cours</button>
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
