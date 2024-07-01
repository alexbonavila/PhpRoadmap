<?php

namespace App\Model;

use MongoDB\BSON\UTCDateTime;

class Post
{
    public string $id;
    public string $userId;
    public string $title;
    public string $content;
    private UTCDateTime $createdAt;
    private UTCDateTime $updatedAt;
    public array $comments;

    public function __construct()
    {
        $this->createdAt = new UTCDateTime();
        $this->updatedAt = new UTCDateTime();
        $this->comments = [];
    }

    // Getters and setters
    public function getId(): string
    {
        return $this->id;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getTitle(): string
    {
        return $this->title;
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

    public function getComments(): array
    {
        return $this->comments;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
        $this->updatedAt = new UTCDateTime();
    }

    public function setContent($content): void
    {
        $this->content = $content;
        $this->updatedAt = new UTCDateTime();
    }

    public function addComment($commentId): void
    {
        $this->comments[] = $commentId;
        $this->updatedAt = new UTCDateTime();
    }

    public function removeComment(string $commentId): void
    {
        print_r("\n");
        print_r($commentId);
        print_r("\n");
        $this->comments = array_values(array_filter($this->comments, function ($element) use ($commentId) {
            return $element !== $commentId;
        }));

        $this->updatedAt = new UTCDateTime();
    }

    public function mapObject($post): void
    {
        $this->id = (string)$post['_id'];
        $this->userId = $post['userId'];
        $this->title = $post['title'];
        $this->content = $post['content'];
        $this->createdAt = $post['createdAt'];
        $this->updatedAt = $post['updatedAt'];
        $this->comments = $post['comments']->getArrayCopy();
    }

    public function toArray(): array
    {
        return [
            'userId' => $this->getUserId(),
            'title' => $this->getTitle(),
            'content' => $this->getContent(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
            'comments' => $this->getComments()
        ];
    }
}

