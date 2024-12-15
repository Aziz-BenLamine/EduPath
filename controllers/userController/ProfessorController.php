<?php
class ProfessorController {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo; // Ensure this matches throughout the class
    }

    public function findProfessorByNameAndPassword($name, $password) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM professor WHERE name = :name AND password = :password");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR); // Compare plain-text password
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception("Error finding professor: " . $e->getMessage());
        }
    }

    public function createProfessor($name, $email, $password, $department) {
        try {
            // Directly store the plain-text password
            $stmt = $this->pdo->prepare("INSERT INTO professor (name, email, password, department) VALUES (:name, :email, :password, :department)");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':department', $department, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error creating professor: " . $e->getMessage());
        }
    }

    public function professorExists($name, $email) {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM professor WHERE name = :name OR email = :email");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            throw new Exception("Error checking professor existence: " . $e->getMessage());
        }
    }

    public function getAllProfessors() {
        try {
            $stmt = $this->pdo->prepare("SELECT id, name, email, department FROM professor");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error fetching professors: " . $e->getMessage());
        }
    }

    public function deleteProfessor($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM professor WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return "Professor deleted successfully.";
        } catch (PDOException $e) {
            return "Error deleting professor: " . $e->getMessage();
        }
    }

    public function countProfessors() {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM professor");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (PDOException $e) {
            return "Error counting professors: " . $e->getMessage();
        }
    }
    public function searchProfessorById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM professor WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error fetching professor by ID: " . $e->getMessage());
        }
    }
    public function searchProfessorByName($username) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM professor WHERE name = :username");
            $stmt->bindParam(':userame', $username, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error fetching professor by ID: " . $e->getMessage());
        }
    }
}
?>
