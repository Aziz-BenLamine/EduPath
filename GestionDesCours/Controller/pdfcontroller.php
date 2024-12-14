<?php
require_once '../../config.php';
require_once '../../Model/pdf.php';

class PdfController{
    public function ajouterpdf($pdf){
        try {
            $db = config::getConnexion();
            $query = $db->prepare('INSERT INTO pdf (description, cours, id_cours) VALUES (:description, :cours, :id_cours)');
            $query->bindValue(':description', $pdf->getDescription());
            $query->bindValue(':cours', $pdf->getCours());
            $query->bindValue(':id_cours', $pdf->getIdCours());
            $query->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function afficherpdfs($id_cours){
        try {
            $db = config::getConnexion();
            $query = $db->prepare('SELECT * FROM pdf WHERE id_cours=:id_cours');
            $query->bindValue(':id_cours', $id_cours);
            $query->execute(['id_cours' => $id_cours]);
            $pdfs = $query->fetchAll(PDO::FETCH_ASSOC);
            return $pdfs;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function supprimerpdf($id){
        $db = config::getConnexion();
        $query = $db->prepare('DELETE FROM pdf WHERE id=:id');
        $query->bindValue(':id', $id);
        $query->execute();
    }
    public function modifierpdf($pdf, $id){
        $db = config::getConnexion();
        $query = $db->prepare('UPDATE pdf SET description=:description, cours=:cours, id_cours=:id_cours WHERE id=:id');
        $query->bindValue(':description', $pdf->getDescription());
        $query->bindValue(':cours', $pdf->getCours());
        $query->bindValue(':id_cours', $pdf->getIdCours());
        $query->bindValue(':id', $id);
        $query->execute();
    }
    public function getpdfbycours($id_cours){
        $db = config::getConnexion();
        $query = $db->prepare('SELECT * FROM pdf WHERE id_cours=:id_cours');
        $query->bindValue(':id_cours', $id_cours);
        $query->execute();
        $pdfs = $query->fetchAll(PDO::FETCH_ASSOC);
        return $pdfs;
    }
}