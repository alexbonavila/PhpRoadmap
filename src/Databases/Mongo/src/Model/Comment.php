<?php

namespace App\Model;

use MongoDB\BSON\UTCDateTime;

class Comment {
    public string $id;
    public string $postId;
    public string $userId;
    public string $content;
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

    public function getPostId(): string
    {
        return $this->postId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreatedAt(): UTCDateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): UTCDateTime
    {
        return $this->updatedAt;
    }

    public function setContent($content): void
    {
        $this->content = $content;
        $this->updatedAt = new UTCDateTime();
    }

    public function mapObject($comment): void
    {
        $this->id = (string) $comment['_id'];
        $this->postId = $comment['postId'];
        $this->userId = $comment['userId'];
        $this->content = $comment['content'];
        $this->createdAt = $comment['createdAt'];
        $this->updatedAt = $comment['updatedAt'];
    }

    public function toArray(): array
    {
        return [
            'postId' => $this->getPostId(),
            'userId' => $this->getUserId(),
            'content' => $this->getContent(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt()
        ];
    }
}
