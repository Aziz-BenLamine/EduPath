<?php

require_once __DIR__ . '/../models/User.php';

class UserController
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getUserByUsername($username)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            // Handle the exception
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
    // Fetch a user by ID
    public function getUserById($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error fetching user: " . $e->getMessage();
        }
    }

    // Fetch an admin by ID
    public function getAdminById($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM admins WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error fetching admin: " . $e->getMessage();
        }
    }

    // Count total users
    public function countUsers()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM users");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (PDOException $e) {
            return "Error counting users: " . $e->getMessage();
        }
    }

    // Count total admins
    public function countAdmins()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM admins");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (PDOException $e) {
            return "Error counting admins: " . $e->getMessage();
        }
    }

    // Delete a user by ID
    public function deleteUser($userId)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error deleting user: " . $e->getMessage();
        }
    }

    // Delete an admin by ID
    public function deleteAdmin($adminId)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM admins WHERE id = :id");
            $stmt->bindParam(':id', $adminId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error deleting admin: " . $e->getMessage();
        }
    }

    // Update a user's details
    public function updateUser($userId, $username, $email)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE users SET username = :username, email = :email WHERE id = :id");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error updating user: " . $e->getMessage();
        }
    }

    // Update an admin's details
    public function updateAdmin($adminId, $username, $email)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE admins SET username = :username, email = :email WHERE id = :id");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':id', $adminId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error updating admin: " . $e->getMessage();
        }
    }

    // Get all users
    public function getAllUsers()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, username, email FROM users");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error fetching users: " . $e->getMessage();
        }
    }

    // Get all admins
    public function getAllAdmins()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, username, email FROM admins");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error fetching admins: " . $e->getMessage();
        }
    }

    // Check if a user exists
    public function userExists($username, $email)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username OR email = :email");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            return "Error checking user existence: " . $e->getMessage();
        }
    }

    // Check if an admin exists
    public function adminExists($username, $email)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM admins WHERE username = :username OR email = :email");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            return "Error checking admin existence: " . $e->getMessage();
        }
    }

    // Create a new user
    public function createUser($username, $email, $password)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error creating user: " . $e->getMessage();
        }
    }

    // Create a new admin
    public function createAdmin($username, $email, $password)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO admins (username, email, password) VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error creating admin: " . $e->getMessage();
        }
    }

    // Find a user by username and password
    public function findUserByUsernameAndPassword($username, $password)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error finding user: " . $e->getMessage();
        }
    }

    // Find an admin by username and password
    public function findAdminByUsernameAndPassword($username, $password)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM admins WHERE username = :username AND password = :password");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error finding admin: " . $e->getMessage();
        }
    }
}
