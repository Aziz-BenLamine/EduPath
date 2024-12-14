<?php
class Pdf{
    public $id;
    public $description;
    public $cours;
    public $id_cours;

    public function __construct($id,$description,$cours,$id_cours){
        $this->id=$id;
        $this->description=$description;
        $this->cours=$cours;
        $this->id_cours=$id_cours;
    }
    public function getId(){
        return $this->id;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getCours(){
        return $this->cours;
    }
    public function getIdCours(){
        return $this->id_cours;
    }
    public function setId($id){
        $this->id=$id;
    }
    public function setDescription($description){
        $this->description=$description;
    }
    public function setCours($cours){
        $this->cours=$cours;
    }
    public function setIdCours($id_cours){
        $this->id_cours=$id_cours;
    }
    
}