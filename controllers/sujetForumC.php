<?php
// sujetForumC.php

require_once "/xampp/htdocs/EduPath/config.php";

class sujetForumC {
    private $pdo;

    public function __construct() {
        $this->pdo = config::getConnexion();
    }

    public function sujetTable() {
        $stmt = $this->pdo->query("SELECT * FROM sujetforum");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listSujets() {
        $stmt = $this->pdo->query("SELECT id, title FROM sujetforum");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addSujet($sujet) {
        $stmt = $this->pdo->prepare("INSERT INTO sujetforum (title, description, date_creation, cree_par) VALUES (:title, :description, :date_creation, :cree_par)");
        $stmt->execute($sujet);
    }

    public function updateSujet($sujet) {
        $stmt = $this->pdo->prepare("UPDATE sujetforum SET title = :title, description = :description WHERE id = :id");
        $stmt->execute($sujet);
    }

    public function deleteSujet($id) {
        $stmt = $this->pdo->prepare("DELETE FROM sujetforum WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function getSujet($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM sujetforum WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function countSujets() {
        $stmt = $this->pdo->query("SELECT COUNT(*) as count FROM sujetforum");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }
}
?>