<?php
// Check if a session is already started, if not, start a new session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$user = isset($_SESSION['username']) ? $_SESSION['username'] : null;
?>

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
      <a href="/EduPath/quizznourane/view/index.php">Quiz</a>
      <a href="/Edupath/views/sujets/forum_home.php">Forum</a>
      <div class="dropdown">
        <button class="dropbtn">Réclamation</button>
        <div class="dropdown-content">
          <a href="/Edupath/views/Frontoffice/addRec.php">Ajouter Réclamation</a>
          <a href="/Edupath/views/Frontoffice/Reclist.php">Liste des Réclamations</a>
        </div>
      </div>
      <?php if ($user): ?>
        <a href="/Edupath/views/logout.php" class="btn-primary">Logout</a>
      <?php else: ?>
        <a href="/Edupath/views/Frontoffice/role_selection.html" class="btn-primary">S'inscrire</a>
      <?php endif; ?>
    </nav>
  </header>
</body>

</html>