<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduPath</title>
  <link rel="stylesheet" href="/Edupath/views/components/header.css">
</head>

<body>
  <header class="header">
    <a href="/Edupath/index.php" class="logo">
      <img src="/Edupath/views/components/EduPathLogo.png" alt="CheminÉdu Logo">
      <span>EduPath</span>
    </a>
    <nav class="nav">
      <a href="/Edupath/GestionDesCours/View/FrontOffice/indexetudiant.php">Cours</a>
      <a href="..\EduPath\quizznourane\view\index.php">Quiz</a>
      <a href="/Edupath/views/sujets/forum_home.php">Forum</a>
      <a href="#">Tuteur</a>
      <div class="dropdown">
        <button class="dropbtn">Réclamation</button>
        <div class="dropdown-content">
          <a href="/Edupath/views/Frontoffice/addRec.php">Ajouter Réclamation</a>
          <a href="/Edupath/views/Frontoffice/Reclist.php">Liste des Réclamations</a>
        </div>
      </div>
      <a href="..\EduPath\views\Frontoffice\role_selection.html" class="btn-primary">S'inscrire</a>
    </nav>
  </header>
</body>

</html>