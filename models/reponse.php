<?php

class reponse {
    private $id;
    private $contenu;
    private $date_creation;
    private $cree_par;
    private $publication_id;

    // Methode creerReponse()
    public function __construct($id, $contenu, $date_creation, $cree_par, $publication_id)
    {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->date_creation = $date_creation;
        $this->cree_par = $cree_par;
        $this->publication_id = $publication_id;
    }

    public function modifierReponse($contenu)
    {
        $this->contenu = $contenu;
    }

    // Methode supprimerReponse()
    /*public function __destruct()
    {
        echo "La reponse a été supprimer";
    }*/

    //Getters
    public function getId()
    {
        return $this->id;
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

    public function getPublicationId()
    {
        return $this->publication_id;
    }

    //Setters
    public function setId($id)
    {
        $this->id = $id;
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

    public function setPublicationId($publication_id)
    {
        $this->publication_id = $publication_id;
    }
}