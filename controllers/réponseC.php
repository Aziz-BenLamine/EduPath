<?php
include_once(__DIR__ .'../../config.php');
include(__DIR__ . '/../models/réponse.php');
class ReponseC{
    public function ajouterReponse($reponse)
    {
        $sql = "INSERT INTO reponse (idr,nom_a, id_rec, date_r, contenu)
        VALUES (:idr,:nom_a , :id_rec, :date_r, :contenu)";
        $db = config::getConnexion();
        var_dump($reponse->getIdReclamation());
        $this->modifierStatut($reponse->getIdReclamation());
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'idr' => $reponse->getId(),
                'nom_a' => $reponse->getNom_a(),
                'id_rec' => $reponse->getIdReclamation(),
                'date_r' => $reponse->getDateR()->format('Y-m-d'),
                'contenu' => $reponse->getContenu(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function modifierStatut($id)
    {
        try {
            var_dump($id);
            $db = config::getConnexion();

            $query = $db->prepare(
                'UPDATE addreclamation SET
                    statut = :statut
                WHERE id = :id'
            );

            $query->execute([
                'statut' => 'traité',
                'id' => $id,
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function hideRec($id)
    {
        $sql = "UPDATE addreclamation SET is_visible = 0 WHERE id = :id";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        $query->execute(['id' => $id]);
    }

}
?>