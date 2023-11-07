<?php

namespace App\Repository;

use App\Model\Post;
use MongoDB\Client as MongoClient;

class PostRepository {
    private Post $postModel;

    public function __construct(MongoClient $client) {
        $this->postModel = new Post($client->selectCollection('my_database', 'posts'));
    }

    public function createPost(array $data): bool {
        return $this->postModel->create($data);
    }

    public function getPostById(string $postId): ?object {
        return $this->postModel->read($postId);
    }

    public function updatePost(string $postId, array $newData): int {
        return $this->postModel->update($postId, $newData);
    }

    public function deletePost(string $postId): int {
        return $this->postModel->delete($postId);
    }
}
