<?php 
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

//defining root directory to make navigation easier ROOT_DIR=C:\xampp\htdocs\forumDiscussionPHP\
define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR);

switch($page) {
    case 'home':
        include ROOT_DIR . 'views/sujets/forum_home.php';
        break;
    case "publication":
        include ROOT_DIR . 'views/publications/publicationsView.php';
        break;
    case "addPublication":
        include ROOT_DIR . 'views/publications/addPublication.php';
        break;
    case "Responses":
        include ROOT_DIR . 'views/reponses/reponsesView.php';
        break;
}

