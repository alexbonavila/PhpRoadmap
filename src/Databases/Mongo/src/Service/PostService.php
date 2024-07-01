<?php

namespace App\Service;

use App\Repository\PostRepository;
use MongoDB\BSON\UTCDateTime;

class PostService {
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository) {
        $this->postRepository = $postRepository;
    }

    public function createPost(array $postData): object
    {
        $result = $this->postRepository->create($postData);

        return $this->postRepository->readById($result->getInsertedId());
    }

    public function getPostsByUserId(string $userId): array {
        return $this->postRepository->findByUserId($userId);
    }

    public function updatePost(string $postId, array $newData): int {
        $newData['updatedAt'] = new UTCDateTime();
        return $this->postRepository->update($postId, $newData);
    }

    public function deletePost(string $postId): int {
        return $this->postRepository->delete($postId);
    }

    public function getAllPosts(): array {
        return $this->postRepository->readAll();
    }

    public function getPostById(string $postId): object|null
    {
        return $this->postRepository->readById($postId);
    }
}
