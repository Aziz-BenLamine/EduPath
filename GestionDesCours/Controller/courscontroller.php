<?php
include '../../config.php';
include '../../Model/cours.php';

class CoursController
{
    public function ajoutercours($cours)
{
    try {
        $db = config::getConnexion();
        $query = $db->prepare('INSERT INTO cours (titre, description, niveau, prix, categorie) VALUES (:titre, :description, :niveau, :prix, :categories)');
        $query->bindValue(':titre', $cours->getTitre());
        $query->bindValue(':description', $cours->getDescription());
        $query->bindValue(':niveau', $cours->getNiveau());
        $query->bindValue(':prix', $cours->getPrix());
        $query->bindValue(':categories', $cours->getCategorie());
        $query->execute();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


    public function affichercours()
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('SELECT * FROM cours');
            $query->execute();
            $cours = $query->fetchAll(PDO::FETCH_ASSOC);

            echo "<div style='display: flex; flex-wrap: wrap; gap: 20px; background-color: #f0f4f8; padding: 30px;'>";
            foreach ($cours as $index => $cour) {
                echo "<div style='flex: 1 1 calc(33.333% - 20px); 
                                border: 1px solid #d1d9e6; 
                                border-radius: 10px; 
                                padding: 20px; 
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
                                text-align: center; 
                                background-color: #ffffff; 
                                transition: transform 0.3s ease;'>
                        <h3 style='color: #0288d1; margin-bottom: 10px;'>" . htmlspecialchars($cour['titre']) . "</h3>
                        <p style='color: #455a64; margin-bottom: 15px;'>" . htmlspecialchars($cour['description']) . "</p>
                        <p style='color: #455a64; margin-bottom: 15px;'>Niveau: " . htmlspecialchars($cour['niveau']) . "</p>
                        <p style='color: #455a64; margin-bottom: 15px;'>Prix: " . htmlspecialchars($cour['prix']) . " €</p>
                        <p style='color: #455a64; margin-bottom: 15px;'>Catégorie: " . htmlspecialchars($cour['categorie']) . "</p>
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

    public function supprimercours($id)
    {
        $db = config::getConnexion();
        $query = $db->prepare('DELETE FROM cours WHERE id=:id');
        $query->bindValue(':id', $id);
        $query->execute();
    }

    public function modifiercours($cours, $id)
    {
        $db = config::getConnexion();
        $query = $db->prepare('UPDATE cours SET titre=:titre, description=:description, niveau=:niveau, prix=:prix, categories=:categories WHERE id=:id');
        $query->bindValue(':titre', $cours->getTitre());
        $query->bindValue(':description', $cours->getDescription());
        $query->bindValue(':niveau', $cours->getNiveau());
        $query->bindValue(':prix', $cours->getPrix());
        $query->bindValue(':categories', $cours->getCategories());
        $query->bindValue(':id', $id);
        $query->execute();
    }

    
}
?>