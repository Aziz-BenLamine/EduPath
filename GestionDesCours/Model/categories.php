<?php
class Categorie{
    public $id;
    public $titre;
    public $description;

    public function __construct($id,$titre,$description){
        $this->id=$id;
        $this->titre=$titre;
        $this->description=$description;
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
    public function setId($id){
        $this->id=$id;
    }
    public function setTitre($titre){
        $this->titre=$titre;
    }
    public function setDescription($description){
        $this->description=$description;
    }
    
}
