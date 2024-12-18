<?php
require_once '../../config.php';
require_once '../../Model/cours.php';

class CoursController
{
    public function ajoutercours($cours)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('INSERT INTO cours (titre, description, niveau, prix, categorie, userid) VALUES (:titre, :description, :niveau, :prix, :categories, :userid)');
            $query->bindValue(':titre', $cours->getTitre());
            $query->bindValue(':description', $cours->getDescription());
            $query->bindValue(':niveau', $cours->getNiveau());
            $query->bindValue(':prix', $cours->getPrix());
            $query->bindValue(':categories', $cours->getCategorie());
            $query->bindValue(':userid', $cours->getUserId());
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
    public function affichercourst($cat_id,$userid)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('SELECT * FROM cours WHERE categorie=:id AND userid=:userid');
            $query->bindValue(':id', $cat_id);
            $query->bindValue(':userid', $userid);
            $query->execute();
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
        $query = $db->prepare('UPDATE cours SET titre=:titre, description=:description, niveau=:niveau, prix=:prix, categorie=:categories, userid=:userid WHERE id=:id');
        $query->bindValue(':titre', $cours->getTitre());
        $query->bindValue(':description', $cours->getDescription());
        $query->bindValue(':niveau', $cours->getNiveau());
        $query->bindValue(':prix', $cours->getPrix());
        $query->bindValue(':categories', $cours->getCategorie());
        $query->bindValue(':userid', $cours->getUserId());
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

    public function getAllCours()
    {
        $db = config::getConnexion();
        $query = $db->prepare('SELECT * FROM cours');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchCours($search)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('SELECT * FROM cours WHERE titre LIKE :search OR description LIKE :search');
            $query->bindValue(':search', '%' . $search . '%');
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getcoursebyid($id)
    {
        $db = config::getConnexion();
        $query = $db->prepare('SELECT * FROM cours WHERE id=:id');
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
