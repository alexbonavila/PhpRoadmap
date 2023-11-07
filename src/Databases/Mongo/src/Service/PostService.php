<?php

namespace App\Service;

use App\Repository\PostRepository;

class PostService {
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository) {
        $this->postRepository = $postRepository;
    }

    public function createPost(array $postData): bool {
        return $this->postRepository->createPost($postData);
    }

    public function getPost(string $postId): ?object {
        return $this->postRepository->getPostById($postId);
    }

    public function updatePost(string $postId, array $postData): bool {
        return $this->postRepository->updatePost($postId, $postData) > 0;
    }

    public function deletePost(string $postId): bool {
        return $this->postRepository->deletePost($postId) > 0;
    }
}