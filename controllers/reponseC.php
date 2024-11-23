<?php
include_once '/xampp/htdocs/EduPath/models/reponse.php';
require_once "/xampp/htdocs/EduPath/config.php";

class reponseC
{
    private $pdo;

    public function __construct() {
        $this->pdo = config::getConnexion();
    }

    public function reponseTable() {
        $stmt = $this->pdo->query("SELECT * FROM reponse");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReponse($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM reponse WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listreponses($id_publication) {
        $stmt = $this->pdo->prepare("SELECT * FROM reponse WHERE publication = :id_publication");
        $stmt->execute(['id_publication' => $id_publication]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function creePar($id) {
        $stmt = $this->pdo->prepare("SELECT nom, prenom FROM utilisateur WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addReponse($reponse) {
        $stmt = $this->pdo->prepare("INSERT INTO reponse (contenu, date_creation, cree_par, publication) VALUES (:contenu, :date_creation, :cree_par, :publication)");
        $stmt->execute($reponse);
    }

    public function updateReponse($reponse) {
        $stmt = $this->pdo->prepare("UPDATE reponse SET contenu = :contenu WHERE id = :id");
        $stmt->execute($reponse);
    }

    public function deleteReponse($id) {
        $stmt = $this->pdo->prepare("DELETE FROM reponse WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
    
    public function countReponses() {
        $stmt = $this->pdo->query("SELECT COUNT(*) as count FROM reponse");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function timeAgo($datetime)
    {
        $time = strtotime($datetime);
        $time = time() - $time;

        $units = [
            'year' => 31536000,
            'month' => 2592000,
            'week' => 604800,
            'day' => 86400,
            'hour' => 3600,
            'minute' => 60,
            'second' => 1,
        ];

        foreach ($units as $unit => $value) {
            if ($time < $value) continue;
            $numberOfUnits = floor($time / $value);
            return $numberOfUnits . ' ' . $unit . (($numberOfUnits > 1) ? 's' : '') . ' ago';
        }

        return 'just now';
    }
}
?>