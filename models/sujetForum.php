<?php

class SujetForum
{
    private $id;
    private $titre;
    private $description;
    private $date_creation;
    private $cree_par;

    // Methode creerSujet()
    public function __construct($id, $titre, $description, $date_creation, $cree_par)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->date_creation = $date_creation;
        $this->cree_par = $cree_par;
    }

    public function modifierSujet($titre, $description)
    {
        $this->titre = $titre;
        $this->description = $description;
    }

    // Methode supprimerSujet()
    /*public function __destruct()
    {
        echo "Le sujet a été supprimer";
    }*/


    //Getters
    public function getId()
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDateCreation()
    {
        return $this->date_creation;
    }

    public function getCreePar()
    {
        return $this->cree_par;
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

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;
    }

    public function setCreePar($cree_par)
    {
        $this->cree_par = $cree_par;
    }
}
