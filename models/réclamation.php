<?php

class reclamation {
    private $id;
    private $nom;
    private $date_c;
    private $email;
    private $sujet;
    private $descript;
    private $tel;
    private $statut;
    private $is_visible;

    public function __construct($id, $nom, $date_c, $email, $sujet, $descript, $tel,$statut,$is_visible) {
        $this->id = $id;
        $this->nom = $nom;
        $this->date_c = $date_c;
        $this->email = $email;
        $this->sujet = $sujet;
        $this->descript = $descript;
        $this->tel = $tel;
        $this->statut = $statut;
        $this->is_visible = $is_visible;
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

    public function getStatut() {
        return $this->statut;
    }
    public function getIs_visible() {
        return $this->is_visible;
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
    public function setStatut($statut) {
        $this->statut = $statut;
    }
    public function setIs_visible($is_visible) {
        $this->is_visible = $is_visible;
    }
}
?>