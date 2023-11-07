<?php

namespace App\Repository;

use App\Model\Comment;
use MongoDB\Client as MongoClient;

class CommentRepository {
    private Comment $commentModel;

    public function __construct(MongoClient $client) {
        $this->commentModel = new Comment($client->selectCollection('my_database', 'comments'));
    }

    public function createComment(array $data): bool {
        return $this->commentModel->create($data);
    }

    public function getCommentById(string $commentId): ?object {
        return $this->commentModel->read($commentId);
    }

    public function updateComment(string $commentId, array $newData): int {
        return $this->commentModel->update($commentId, $newData);
    }

    public function deleteComment(string $commentId): int {
        return $this->commentModel->delete($commentId);
    }
}
