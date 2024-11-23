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
      <h1>ADMIN - Forum Discussion</h1>
      <p>GESTION</p>
      <div>
        <a href="?page=sujets">SUJETS</a>
        <a href="?page=publication">PUBLICATIONS</a>
        <a href="?page=reponses">REPONSES</a>
      </div>
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