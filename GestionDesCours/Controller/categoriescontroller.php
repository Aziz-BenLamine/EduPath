<?php
include '../../config.php';
include '../../Model/categories.php';

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
            $categories = $query->fetchAll(PDO::FETCH_ASSOC);

            echo "<div style='display: flex; flex-wrap: wrap; gap: 20px; background-color: #f0f4f8; padding: 30px;'>";
            foreach ($categories as $index => $category) {
                echo "<div style='flex: 1 1 calc(33.333% - 20px); 
                                border: 1px solid #d1d9e6; 
                                border-radius: 10px; 
                                padding: 20px; 
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
                                text-align: center; 
                                background-color: #ffffff; 
                                transition: transform 0.3s ease;'>
                        <h3 style='color: #0288d1; margin-bottom: 10px;'>" . htmlspecialchars($category['titre']) . "</h3>
                        <p style='color: #455a64; margin-bottom: 15px;'>" . htmlspecialchars($category['description']) . "</p>
                    </div>";

                if (($index + 1) % 3 === 0) {
                    echo "<div style='flex-basis: 100%; height: 0;'></div>";
                }
            }
            echo "</div>";
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
    
}
?>
