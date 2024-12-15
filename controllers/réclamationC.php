<?php
include_once(__DIR__ .'../../config.php');
include(__DIR__ . '/../models/réclamation.php');

class ReclamationC
{
    public function ajouterReclamation($reclamation)
    {
        $sql = "INSERT INTO addreclamation (id, nom, date_c, email, sujet, descript, tel, statut, is_visible)
        VALUES (:id, :nom, :date_c, :email, :sujet, :descript, :tel, :statut,:is_visible)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $reclamation->getId(),
                'nom' => $reclamation->getNom(),
                'date_c' => $reclamation->getDateC()->format('Y-m-d'),
                'email' => $reclamation->getEmail(),
                'sujet' => $reclamation->getSujet(),
                'descript' => $reclamation->getDescript(),
                'tel' => $reclamation->getTel(),
                'statut' => $reclamation->getStatut(),
                'is_visible' => $reclamation->getIs_visible()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function listeReclamations()
    {
        $sql = "SELECT * FROM addreclamation";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function supprimerReclamation($id)
    {
        $sql = "DELETE FROM addreclamation WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function modifierReclamation($reclamation, $id)
    {
        try {
            $db = config::getConnexion();

            $query = $db->prepare(
                'UPDATE addreclamation SET 
                    nom = :nom,
                    date_c = :date_c,
                    email = :email,
                    sujet = :sujet,
                    descript = :descript
                WHERE id = :id'
            );

            $query->execute([
                'id' => $id,
                'nom' => $reclamation->getNom(),
                'date_c' => $reclamation->getDateC(),
                'email' => $reclamation->getEmail(),
                'sujet' => $reclamation->getSujet(),
                'descript' => $reclamation->getDescript()
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function afficherReclamation($id)
    {
        $sql = "SELECT * from addreclamation where id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();

            $reclamation = $query->fetch();
            return $reclamation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function listeReclamationsMasquees()
    {
        $sql = "SELECT * FROM addreclamation WHERE is_visible = 0";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}
?>