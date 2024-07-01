<?php

namespace App\Model;

use DateTime;
use MongoDB\BSON\UTCDateTime;

class User {
    public string $id;
    public string $username;
    public string $email;
    public string $password;
    private UTCDateTime $createdAt;
    private UTCDateTime $updatedAt;

    public function __construct() {
        $this->createdAt = new UTCDateTime();
        $this->updatedAt = new UTCDateTime();
    }

    // Getters and setters
    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): UTCDateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): UTCDateTime
    {
        return $this->updatedAt;
    }

    public function setUsername($username): void
    {
        $this->username = $username;
        $this->updatedAt = new UTCDateTime();
    }

    public function setEmail($email): void
    {
        $this->email = $email;
        $this->updatedAt = new UTCDateTime();
    }

    public function setPassword($password): void
    {
        $this->password = $password;
        $this->updatedAt = new UTCDateTime();
    }

    public function mapObject($user): void
    {
        $this->id = (string) $user['_id'];
        $this->username = $user['username'];
        $this->email = $user['email'];
        $this->password = $user['password'];
        $this->createdAt = $user['createdAt'];
        $this->updatedAt = $user['updatedAt'];
    }

    public function toArray(): array
    {
        return [
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
        ];
    }
}