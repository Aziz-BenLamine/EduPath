<?php 
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch($page) {
    case 'home':
        include './views/sujets/forum_home.php';
        break;
}

