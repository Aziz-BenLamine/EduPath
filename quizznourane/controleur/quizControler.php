<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/quizModel.php';

class quizs 
    {
        public function affichequestion() {
            $conn = config::getConnexion();
            $requette = $conn->prepare("SELECT * FROM question");
            $requette->execute();
            $resultats = $requette->fetchAll(PDO::FETCH_ASSOC);
            return $resultats;
        }
    
        public function affichequestionQuiz($id) {
            $conn = config::getConnexion();
            $requette = $conn->prepare("SELECT * FROM question WHERE id_quiz = :id");
            $requette->execute(['id' => $id]);
            $resultats = $requette->fetchAll(PDO::FETCH_ASSOC);
            return $resultats;
        }
    
        public function addquestion($question) {
            $sql = "INSERT INTO question (idq, question, typeq, id_quiz, numR) 
                    VALUES (:idq, :question, :typeq, :id_quiz, :numR)";
            $conn = config::getConnexion();
            try {
                $query = $conn->prepare($sql);
                $query->execute([
                    ':idq' => $question->getIdq(), 
                    ':question' => $question->getQuestion(),
                    ':typeq' => $question->getTypeq(),
                    ':id_quiz' => $question->getId_quiz(),
                    ':numR' => $question->getNumR()
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
            try {
                $req = $conn->prepare($sql);
                $req->bindValue(':idq', $idq);
                $req->execute();
            } catch (Exception $e) {
                die('Error: ' . $e->getMessage());
            }
        }
    
        public function updatequestion($question, $idq) {
            $sql = "UPDATE question SET 
                    question = :question, 
                    typeq = :typeq,
                    id_quiz = :id_quiz,
                    numR = :numR 
                    WHERE idq = :idq";
    
            $conn = config::getConnexion();
            try {
                $list = $conn->prepare($sql);
                $list->bindValue(':idq', $idq);
                $list->bindValue(':question', $question->getQuestion());
                $list->bindValue(':typeq', $question->getTypeq());
                $list->bindValue(':id_quiz', $question->getId_quiz());
                $list->bindValue(':numR', $question->getNumR());
                $list->execute();
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
            return $list;
        }
    //QUIZ  
    public function afficheQuiz() {
        $conn = config :: getConnexion();
        $requette = $conn->prepare("select * from quiz");
        $requette->execute();
        $resultats = $requette->fetchAll(PDO::FETCH_ASSOC);
        return $resultats ;
    }
    public function addQuiz($quiz) {
        $sql = "INSERT INTO quiz (titre, description, categorie , image) VALUES (:titre, :description, :categorie , :image)";
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                ':titre' => $quiz->getTitre(), 
                ':description' => $quiz->getDescription(),
                ':categorie' => $quiz->getCategorie(),
                ':image' => $quiz->getImage()
            ]);
            return true; // Indicate success
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false; // Indicate failure
        }
    }

    public function updatequiz($Quiz) {
        $sql = "UPDATE quiz SET 
                titre = :titre,
                description = :description, 
                categorie = :categorie, 
                image = :image
                WHERE id = :id";
    
        $conn = config::getConnexion();
        try {
            $list = $conn->prepare($sql);
            $list->bindValue(':titre', $Quiz->getTitre());
            $list->bindValue(':description', $Quiz->getDescription());
            $list->bindValue(':categorie', $Quiz->getCategorie());
            $list->bindValue(':image', $Quiz->getImage());
            $list->bindValue(':id', $Quiz->getId());
            $list->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    //Reponse

    public function addReponse($reponse) {
        $sql = "INSERT INTO reponse (reponseText, score, correction , id_question ) VALUES (:reponseText, :score, :correction , :id_question)";
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                ':reponseText' => $reponse->getReponseText(), 
                ':score' => $reponse->getScore(),
                ':correction' => $reponse->getCorrection(),
                ':id_question' => $reponse->getId_question()
            ]);
            return true; // Indicate success
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false; // Indicate failure
        }
    }
    public function getNumRForQuestion($id_question) {
        $sql = "SELECT numR FROM question WHERE idq = :id_question";
        $conn = config::getConnexion();  // Get the database connection
        
        try {
            $stmt = $conn->prepare($sql);  // Prepare the query
            $stmt->bindParam(':id_question', $id_question);  // Bind the parameter
            $stmt->execute();  // Execute the query
            
            return $stmt->fetchColumn();  // Return the 'numR' value (maximum responses allowed)
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;  // Return false if there’s an error
        }
    }
    public function getResponseCountForQuestion($id_question) {
        $sql = "SELECT COUNT(*) FROM reponse WHERE id_question = :id_question";
        $conn = config::getConnexion();  // Get the database connection
        
        try {
            $stmt = $conn->prepare($sql);  // Prepare the query
            $stmt->bindParam(':id_question', $id_question);  // Bind the parameter
            $stmt->execute();  // Execute the query
            
            return $stmt->fetchColumn();  // Return the count of responses
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;  // Return false if there’s an error
        }
    }
        
    public function afficherReponse() {

        
        $conn = config :: getConnexion();
        $requette = $conn->prepare("select * from reponse");
        $requette->execute();
        $resultats = $requette->fetchAll(PDO::FETCH_ASSOC);
        return $resultats ;
    }
    public function updateReponse($Reponse, $id) {
        $sql = "UPDATE reponse SET 
                reponseText = :reponseText, 
                score = :score,
                correction = :correction,
                id_question = :id_question 
                WHERE id = :id";
    
        $conn = config::getConnexion();
        try {
            $list = $conn->prepare($sql);
            $list->bindValue(':id', $id);
            $list->bindValue(':reponseText', $Reponse->getReponseText());
            $list->bindValue(':score', $Reponse->getScore());
            $list->bindValue(':correction', $Reponse->getCorrection());
            $list->bindValue(':id_question', $Reponse->getId_question());
            $list->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $list;
    }
    public function searchQuestions($query) { 
        $sql = "SELECT * FROM question WHERE question LIKE :query OR typeq LIKE :query";
        $conn = Config::getConnexion(); // Use existing database connection from Config
    
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute(['query' => '%' . $query . '%']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return results as an associative array
        } catch (Exception $e) {
            // Log the error and rethrow it
            error_log("Error searching questions: " . $e->getMessage());
            throw new Exception("Error searching questions.");
        }
    }
    

}
?>