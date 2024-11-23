<?php
require_once "/xampp/htdocs/EduPath/models/publication.php";
require_once "/xampp/htdocs/EduPath/config.php";
class publicationC {
    private $pdo;

    public function __construct() {
        $this->pdo = config::getConnexion();
    }

    public function publicationTable() {
        $stmt = $this->pdo->query("SELECT * FROM publication");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //CRUD
    public function listPublications($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM publication WHERE sujet = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPublication($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM publication WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function addPublication($publication){
        $stmt = $this->pdo->prepare("INSERT INTO publication (titre, contenu, date_creation, cree_par, sujet) VALUES (:titre, :contenu, :date_creation, :cree_par, :sujet)");
        $stmt->execute($publication);
    }

    public function deletePublication($id) {
        $stmt = $this->pdo->prepare("DELETE FROM publication WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function updatePublication($data) {
        $sql = "UPDATE publication SET titre = :titre, contenu = :contenu WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':titre' => $data['title'],
                        ':contenu' => $data['description'],
                        ':id' => $data['id']
                      ]);
    }

    //STATS
    public function countPublications() {
        $stmt = $this->pdo->query("SELECT COUNT(*) as count FROM publication");
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