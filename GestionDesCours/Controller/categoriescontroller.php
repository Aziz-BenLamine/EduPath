<?php
require_once '../../config.php';
require_once '../../Model/categories.php';

class CategoriesController
{
    public function ajouterCategories($categories)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('INSERT INTO categories (titre, description) VALUES (:titre, :description)');
            $query->bindValue(':titre', $categories->getTitre());
            $query->bindValue(':description', $categories->getDescription());
            $query->execute();
        } catch (Exception $e) {
            die( 'Error: ' . $e->getMessage());
        }
    }

    public function affichercategories()
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('SELECT * FROM categories');
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function supprimercategories($id)
    {
        $db = config::getConnexion();
        $query = $db->prepare('DELETE FROM categories WHERE id=:id');
        $query->bindValue(':id', $id);
        $query->execute();
    }

    public function modifiercategories($categories, $id)
    {
        $db = config::getConnexion();
        $query = $db->prepare('UPDATE categories SET titre=:titre, description=:description WHERE id=:id');
        $query->bindValue(':titre', $categories->getTitre());
        $query->bindValue(':description', $categories->getDescription());
        $query->bindValue(':id', $id);
        $query->execute();
    }
    public function getCategoryCount()
    {
        $db = config::getConnexion();
        $query = $db->prepare('SELECT COUNT(*) FROM categories');
        $query->execute();
        return $query->fetchColumn();
    }
    public function getCategoriesById($id)
    {
        $db = config::getConnexion();
        $query = $db->prepare('SELECT * FROM categories WHERE id=:id');
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>
