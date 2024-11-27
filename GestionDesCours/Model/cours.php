<?php

require_once 'categories.php';

class Cours{
    public $id;
    public $titre;
    public $description;
    public $niveau;
    public $prix;
    public $categorie;

    public function __construct($id,$titre,$description,$niveau,$prix,$categorie){
        $this->id=$id;
        $this->titre=$titre;
        $this->description=$description;
        $this->niveau=$niveau;
        $this->prix=$prix;
        $this->categorie=$categorie;
    }

    public function getId(){
        return $this->id;
    }
    public function getTitre(){
        return $this->titre;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getNiveau(){
        return $this->niveau;
    }
    public function getPrix(){
        return $this->prix;
    }
    public function getCategorie(){
        return $this->categorie;
    }
    public function setId($id){
        $this->id=$id;
    }
    public function setTitre($titre){
        $this->titre=$titre;
    }
    public function setDescription($description){
        $this->description=$description;
    }
    public function setNiveau($niveau){
        $this->niveau=$niveau;
    }
    public function setPrix($prix){
        $this->prix=$prix;
    }
    public function setCategorie($categorie){
        $this->categorie=$categorie;
    }
}
