<?php

namespace App\Model;

use MongoDB\BSON\UTCDateTime;

class Comment {
    private $id;
    private $postId;
    private $userId;
    private $content;
    private $createdAt;
    private $updatedAt;

    public function __construct($postId, $userId, $content) {
        $this->postId = $postId;
        $this->userId = $userId;
        $this->content = $content;
        $this->createdAt = new UTCDateTime();
        $this->updatedAt = new UTCDateTime();
    }

    // Getters and setters
    public function getId() {
        return $this->id;
    }

    public function getPostId() {
        return $this->postId;
    }

    public function getUserId() {
        return $this->userId;
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

    public function setContent($content) {
        $this->content = $content;
        $this->updatedAt = new UTCDateTime();
    }
}
