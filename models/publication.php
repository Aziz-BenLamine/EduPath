<?php

class Publication {

    private $id;
    private $titre;
    private $contenu;
    private $date_creation;
    private $cree_par;
    private $sujet_id;


    // Methode creerPublication()
    public function __construct($id, $titre, $contenu, $date_creation, $cree_par, $sujet_id)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->date_creation = $date_creation;
        $this->cree_par = $cree_par;
        $this->sujet_id = $sujet_id;
    }

    public function modifierPublication($titre, $contenu)
    {
        $this->titre = $titre;
        $this->contenu = $contenu;
    }

    // Methode supprimerPublication()
    public function __destruct()
    {
        echo "La publication a été supprimer";
    }

    //Getters
    public function getId()
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function getDateCreation()
    {
        return $this->date_creation;
    }

    public function getCreePar()
    {
        return $this->cree_par;
    }

    public function getSujetId()
    {
        return $this->sujet_id;
    }

    //Setters

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;
    }

    public function setCreePar($cree_par)
    {
        $this->cree_par = $cree_par;
    }

    public function setSujetId($sujet_id)
    {
        $this->sujet_id = $sujet_id;
    }    
}