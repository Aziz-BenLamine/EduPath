<?php
class reponse {
    private $idr;
    private $nom_a;
    private $id_rec;
    private $date_r;
    private $contenu;

    public function __construct($idr,$nom_a, $id_rec, $date_r, $contenu) {
        $this->idr = $idr;
        $this->nom_a = $nom_a;
        $this->id_rec = $id_rec;
        $this->date_r = $date_r;
        $this->contenu = $contenu;
    }

    // Getters
    public function getId() {
        return $this->idr;
    }
    public function getNom_a() {
        return $this->nom_a;
    }
    public function getIdReclamation() {
        return $this->id_rec;
    }

    public function getDateR() {
        return $this->date_r;
    }

    public function getContenu() {
        return $this->contenu;
    }
    // Setters
    public function setId($idr) {
        $this->idr = $idr;
    }
    public function setNom_a($nom_a) {
        $this->nom_a = $nom_a;
    }
    public function setIdReclamation($id_rec) {
        $this->id_rec = $id_rec;
    }

    public function setDateR($date_r) {
        $this->date_r = $date_r;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }
}
?>