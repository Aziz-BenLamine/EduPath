<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'publication';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>forumAdmin</title>
  <link rel="stylesheet" href="/Edupath/css/backoffice.css" />
</head>

<body>
  <?php include 'C:\xampp\htdocs\EduPath\views/components/sidebar.php'; ?>
  <div class="content">
    <h1>Admin - Forum Discussion</h1>
    <p>Bienvenue dans le panneau d'administration du forum. Ici, vous pouvez gérer les sujets, les publications et les réponses du forum. Utilisez le menu ci-dessous pour accéder aux différentes sections.</p>
    <nav>
      <a href="?page=sujets">Sujets</a>
      <a href="?page=publication">Publications</a>
      <a href="?page=reponses">Reponses</a>
    </nav>
    <div>
      <?php
      switch ($page) {
        case 'sujets':
          include 'sujets.php';
          break;
        case 'reponses':
          include 'reponses.php';
          break;
        case 'publication':
        default:
          include 'publications.php';
          break;
      }
      ?>
    </div>
  </div>

</body>

</html>