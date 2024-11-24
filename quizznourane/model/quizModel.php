<?php

class Quiz {
    private $id;
    private $titre;
    private $description;
    private $categorie;
    private string $image;
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of categorie
     */ 
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set the value of categorie
     *
     * @return  self
     */ 
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function ajouterQuestion(Question $question) {
        $this->questions[] = $question;
    }
}
class Question {
    private $idq;
    private $question;
    private $typeq;
    private $id_quiz;
    public function getIdq()
    {
        return $this->idq;
    }
    public function setIdq($idq)
    {
        $this->idq = $idq;

        return $this;
    }
    public function getQuestion()
    {
        return $this->question;
    }
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }
    public function getTypeq()
    {
        return $this->typeq;
    }
    public function setTypeq($typeq)
    {
        $this->typeq = $typeq;

        return $this;
    }
    public function setId_quiz($id_quiz)
    {
        $this->id_quiz = $id_quiz;

        return $this;
    }
    public function getId_quiz()
    {
        return $this->id_quiz;
    }
}
class Reponse {
    private $id;
    private $reponseText;
    private $score;
    private $correction;
    private $id_question;

    // Getter et Setter pour $id
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    // Getter et Setter pour $reponseText
    public function getReponseText() {
        return $this->reponseText;
    }

    public function setReponseText($reponseText) {
        $this->reponseText = $reponseText;
    }

    // Getter et Setter pour $score
    public function getScore() {
        return $this->score;
    }

    public function setScore($score) {
        $this->score = $score;
    }

    // Getter et Setter pour $correction
    public function getCorrection() {
        return $this->correction;
    }

    public function setCorrection($correction) {
        $this->correction = $correction;
    }

    // Getter et Setter pour $question
    public function getId_question() {
        return $this->id_question;
    }

    public function setId_question($id_question) {
        $this->id_question = $id_question;
    }
}

 ?>