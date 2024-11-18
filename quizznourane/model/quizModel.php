<?php

/*class Quiz {
    private $id;
    private $titre;
    private $description;
    private $creationDate;
    private $difficulte;
    private $categorie;
    private $questions;


    public function ajouterQuestion(Question $question) {
        $this->questions[] = $question;
    }
}*/

class Question {
    private $idq;
    private $question;
    private $typeq;
    
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




}

/*class Reponse {
    private $id;
    private $reponseText;
    private $score;
    private $correction;
    private $question;
}*/
 ?>