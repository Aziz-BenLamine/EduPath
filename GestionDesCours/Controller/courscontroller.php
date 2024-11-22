<?php
require_once '../../config.php';
require_once '../../Model/cours.php';

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


    public function affichercours($cat_id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('SELECT * FROM cours WHERE categorie=:id');
            $query->bindValue(':cat_id', $cat_id);
            $query->execute(['id' => $cat_id]);
            $cours = $query->fetchAll(PDO::FETCH_ASSOC);
            return $cours;
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
        $query = $db->prepare('UPDATE cours SET titre=:titre, description=:description, niveau=:niveau, prix=:prix, categorie=:categories WHERE id=:id');
        $query->bindValue(':titre', $cours->getTitre());
        $query->bindValue(':description', $cours->getDescription());
        $query->bindValue(':niveau', $cours->getNiveau());
        $query->bindValue(':prix', $cours->getPrix());
        $query->bindValue(':categories', $cours->getCategorie());
        $query->bindValue(':id', $id);
        $query->execute();
    }
    public function getCoursCount()
    {
        $db = config::getConnexion();
        $query = $db->prepare('SELECT COUNT(*) FROM cours');
        $query->execute();
        return $query->fetchColumn();
    }
    public function getCoursById($id)
    {
        $db = config::getConnexion();
        $query = $db->prepare('SELECT * FROM cours WHERE id=:id');
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
}
?>