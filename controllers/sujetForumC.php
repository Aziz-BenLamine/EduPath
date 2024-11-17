<?php
// sujetForumC.php

require_once "/xampp/htdocs/EduPath/config.php";

class sujetForumC {
    private $pdo;

    public function __construct() {
        $this->pdo = config::getConnexion();
    }

    public function listSujets() {
        $stmt = $this->pdo->query("SELECT id, title FROM sujetforum");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSujet($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM sujetforum WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>