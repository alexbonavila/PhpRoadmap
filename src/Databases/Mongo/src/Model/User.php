<?php

namespace App\Model;

use MongoDB\BSON\UTCDateTime;

class User {
    private $id;
    private $username;
    private $email;
    private $password;
    private $createdAt;
    private $updatedAt;

    public function __construct($username, $email, $password) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = new UTCDateTime();
        $this->updatedAt = new UTCDateTime();
    }

    // Getters and setters
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function setUsername($username) {
        $this->username = $username;
        $this->updatedAt = new UTCDateTime();
    }

    public function setEmail($email) {
        $this->email = $email;
        $this->updatedAt = new UTCDateTime();
    }

    public function setPassword($password) {
        $this->password = $password;
        $this->updatedAt = new UTCDateTime();
    }
}