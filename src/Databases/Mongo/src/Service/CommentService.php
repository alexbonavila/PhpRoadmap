<?php

namespace App\Service;

use App\Repository\CommentRepository;

class CommentService {
    private CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository) {
        $this->commentRepository = $commentRepository;
    }

    public function createComment(array $commentData): bool {
        return $this->commentRepository->createComment($commentData);
    }

    public function getComment(string $commentId): ?object {
        return $this->commentRepository->getCommentById($commentId);
    }

    public function updateComment(string $commentId, array $commentData): bool {
        return $this->commentRepository->updateComment($commentId, $commentData) > 0;
    }

    public function deleteComment(string $commentId): bool {
        return $this->commentRepository->deleteComment($commentId) > 0;
    }
}