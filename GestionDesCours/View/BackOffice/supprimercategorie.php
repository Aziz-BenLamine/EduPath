<?php
include_once '../../Controller/categoriescontroller.php';
$CategoriesController = new CategoriesController();
if (isset($_GET['id'])){
$id = $_GET['id'];
$CategoriesController->supprimercategories($id);
header('Location: indexadmin.php');
}
else{
    echo "Erreur";
}