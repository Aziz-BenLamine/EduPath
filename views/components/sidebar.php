<!DOCTYPE html>
<html lang="fr">

<head>
  <link rel="stylesheet" href="/EduPath/views/components/side.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <script src="/EduPath/views/components/side.js" defer></script>
  <style>
    .sidebar a {
      display: block;
      padding: 10px;
      text-decoration: none;
      color: #333;
    }

    .sidebar a:hover {
      background-color: #ddd;
    }

    .sidebar .submenu {
      display: none;
      padding-left: 20px;
    }

    .sidebar a:hover+.submenu,
    .submenu:hover {
      display: block;
    }
  </style>
</head>

<body>
  <div class="sidebar" role="navigation" aria-label="Sidebar">
    <div class="logo">
      <img src="/EduPath/views/components/EduPathLogo.png" alt="EduPath Logo" />
      <span>EduPath</span>
    </div>
    <a href="/EduPath/views/BackOffice/dashboard.php" class="active"><i class="fas fa-users"></i> Gestion des utilisateurs</a>
    <a href="/EduPath/GestionDesCours/View/BackOffice/indexadmin.php">Gestion des categories</a>
    <a href="/EduPath/GestionDesCours/View/BackOffice/gesctioncours.php"><i class="fas fa-book"></i> Gestion des cours</a>
    <a href="/EduPath/views/BackOffice/GestionForum/forumAdmin.php?page=publication"><i class="fas fa-comments"></i> Gestion du forum</a>
    <a href="/EduPath/quizznourane/back.php"><i class="fas fa-question-circle"></i> Gestion des quizs</a>
    <a href="/EduPath/views/BackOffice/listeRec.php" class="active"><i class="fas fa-exclamation-triangle"></i> Gestion des reclamations</a>
    <div class="submenu">
      <a href="/EduPath/views/BackOffice/sidebar/hiddenList.php"><i class="fas fa-eye-slash"></i> Réclamations masquées</a>
    </div>

  </div>
  <button class="toggle-btn">&#9664;</button>

</body>

</html>