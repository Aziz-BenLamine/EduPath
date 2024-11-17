<?php

class reclamation {
    private $id;
    private $nom;
    private $date_c;
    private $email;
    private $sujet;
    private $descript;
    private $tel;

    public function __construct($id, $nom, $date_c, $email, $sujet, $descript, $tel) {
        $this->id = $id;
        $this->nom = $nom;
        $this->date_c = $date_c;
        $this->email = $email;
        $this->sujet = $sujet;
        $this->descript = $descript;
        $this->tel = $tel;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getDateC() {
        return $this->date_c;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSujet() {
        return $this->sujet;
    }

    public function getDescript() {
        return $this->descript;
    }
    public function getTel() {
        return $this->tel;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setDateC($date_c) {
        $this->date_c = $date_c;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSujet($sujet) {
        $this->sujet = $sujet;
    }

    public function setDescript($descript) {
        $this->descript = $descript;
    }
    public function setTel($tel) {
        $this->tel = $tel;
    }
}
?>