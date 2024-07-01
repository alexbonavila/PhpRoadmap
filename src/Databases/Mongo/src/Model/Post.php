<?php

namespace App\Model;

use MongoDB\BSON\UTCDateTime;

class Post {
    private $id;
    private $userId;
    private $title;
    private $content;
    private $createdAt;
    private $updatedAt;
    private $comments;

    public function __construct($userId, $title, $content) {
        $this->userId = $userId;
        $this->title = $title;
        $this->content = $content;
        $this->createdAt = new UTCDateTime();
        $this->updatedAt = new UTCDateTime();
        $this->comments = [];
    }

    // Getters and setters
    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function getComments() {
        return $this->comments;
    }

    public function setTitle($title) {
        $this->title = $title;
        $this->updatedAt = new UTCDateTime();
    }

    public function setContent($content) {
        $this->content = $content;
        $this->updatedAt = new UTCDateTime();
    }

    public function addComment($commentId) {
        $this->comments[] = ['commentId' => $commentId];
        $this->updatedAt = new UTCDateTime();
    }
}

