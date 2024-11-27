<?php
include_once 'D:\server\htdocs\GestionDesCours\Controller\categoriescontroller.php';
$categoryController = new CategoriesController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    
    $category = new Categorie($id, $titre, $description);
    $category->setTitre($titre);
    $category->setDescription($description);
    
    $categoryController->modifiercategories($category, $id);
    header('Location: indexadmin.php');
}
