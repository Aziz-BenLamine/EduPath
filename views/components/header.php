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
    <a href="#" class="logo">
      <img src="/Edupath/views/components/EduPathLogo.png" alt="CheminÉdu Logo">
      <span>EduPath</span>
    </a>
    <nav class="nav">
      <a href="#">Cours</a>
      <a href="#">Quiz</a>
      <a href="#">Forum</a>
      <a href="#">Enseigner</a>
      <div class="dropdown">
        <button class="dropbtn">Réclamation</button>
        <div class="dropdown-content">
          <a href="/Edupath/views/Frontoffice/addRec.php">Ajouter Réclamation</a>
          <a href="/Edupath/views/Frontoffice/Reclist.php">Liste des Réclamations</a>
        </div>
      </div>
      <a href="#">Se connecter</a>
      <a href="#" class="btn-primary">S'inscrire</a>
    </nav>
  </header>
</body>
</html>