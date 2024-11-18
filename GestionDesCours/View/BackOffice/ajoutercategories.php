<?php
include_once 'D:\server\htdocs\GestionDesCours\Controller\categoriescontroller.php';


$categoriesController = new CategoriesController();


$categorie = new Categorie(
    1,
    $_POST['categoryTitle'],
    $_POST['categoryDescription']
);

var_dump($categorie);
$categoriesController->ajoutercategories($categorie);

header('location: indexadmin.php');
?>
