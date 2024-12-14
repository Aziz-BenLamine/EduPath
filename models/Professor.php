<?php

class Professor {
    private $id;
    private $username;
    private $email;
    private $password;
    private $department;
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Getters and Setters for encapsulated properties

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUsername() {
        return $this->username; // Change from $this->name to $this->username
    }
    
    public function setUsername($username) {
        $this->username = $username; // Change from $this->name to $this->username
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password; // Plain-text password (consider security risks)
    }

    public function getDepartment() {
        return $this->department;
    }

    public function setDepartment($department) {
        $this->department = $department;
    }
}
?>