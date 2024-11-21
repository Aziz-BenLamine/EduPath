<?php
include '../../quizznourane/config.php';
include '../../quizznourane/model/quizModel.php';


class quizs {
    public function affichequestion() {
        $sql = "SELECT * FROM question";
        $conn = config::getConnexion();
        try {
            $liste = $conn->query($sql);  
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function addquestion($question) {
        $sql = "INSERT INTO question (idq, question, typeq) VALUES (:idq, :question, :typeq)";
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                ':idq' => $question->getIdq(), 
                ':question' => $question->getQuestion(),
                ':typeq' => $question->getTypeq()
            ]);
            return true; // Indicate success
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false; // Indicate failure
        }
    }
    

    public function deletequestion($idq) {
        $sql = "DELETE FROM question WHERE idq = :idq";
        $conn = config::getConnexion();
        $req = $conn->prepare($sql);
        $req->bindValue(':idq', $idq);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updatequestion($question, $idq) {
        $sql = "UPDATE question SET 
                question = :question, 
                typeq = :typeq 
                WHERE idq = :idq";
    
        $conn = config::getConnexion();
        try {
            $list = $conn->prepare($sql);
            $list->bindValue(':idq', $idq);
            $list->bindValue(':question', $question->getQuestion());
            $list->bindValue(':typeq', $question->getTypeq());
            $list->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $list;
    }
}
?>