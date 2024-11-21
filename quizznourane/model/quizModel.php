<?php

/*class Quiz {
    private $id;
    private $titre;
    private $descrpt;
    private $creationDate;
    private $difficulte;
    private $categorie;


    public function getIdqz()
    {
        return $this->idqz;
    }
    public function setIdqz($idqz)
    {
        $this->idqz = $idqz;

        return $this;
    }
    public function getTitre()
    {
        return $this->titre;
    }
    public function setTitre($titre)
    {
        $this->titre= $titre;

        return $this;
    }
    public function getDescrpt()
    {
        return $this->descrpt;
    }
    public function setDescrpt($descrpt)
    {
        $this->descrpt = $descrpt;

        return $this;
    }
    
    public function getCreationdate()
    {
        return $this->creationdate;
    }
    public function setCreationdate($creationdate)
    {
        $this->creationdate = $creationdate;

        return $this;
    }public function getDifficulte()
    {
        return $this->difficulte;
    }
    public function setDifficulte($difficulte)
    {
        $this->difficulte = $difficulte;

        return $this;
  
    }
    public function getCategorie()
    {
        return $this->categorie;
    }
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }
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
    private $idr;
    private $reponse;
    private $score;
    private $correction;

    public function getIdr()
    {
        return $this->idr;
    }
    public function setIdq($idr)
    {
        $this->idr = $idr;

        return $this;
    }
    public function getReponse()
    {
        return $this->reponse;
    }
    public function setReponse($reponse)
    {
        $this->reponse= $reponse;

        return $this;
    }
    public function getScore()
    {
        return $this->score;
    }
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }
    public function getCorrection()
    {
        return $this->correction;
    }
    public function setCorrection($correction)
    {
        $this->correction = $correction;

        return $this;
    }
}*/
 ?>