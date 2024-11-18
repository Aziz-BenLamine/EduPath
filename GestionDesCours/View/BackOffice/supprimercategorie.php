<?php
include_once 'D:\server\htdocs\GestionDesCours\Controller\categoriescontroller.php';

$CategoriesController = new CategoriesController();

// Check if 'id' parameter exists in the URL
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $CategoriesController->supprimercategories($id);
    header('location: indexadmin.php');
    exit();
} else {
    
    echo "ID de catégorie non fourni.";
}
