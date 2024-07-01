<?php

namespace App\Service;

use App\Repository\CommentRepository;
use MongoDB\BSON\UTCDateTime;

class CommentService {
    private CommentRepository $commentRepository;
    private PostService $postService;

    public function __construct(CommentRepository $commentRepository, PostService $postService) {
        $this->commentRepository = $commentRepository;
        $this->postService = $postService;
    }

    public function createComment(array $commentData): object
    {
        $result = $this->commentRepository->create($commentData);
        if ($result->isAcknowledged()) {
            // Add comment to the post
            $commentId = $result->getInsertedId();
            $post = $this->postService->getPostById($commentData["postId"]);
            $post->comments[] = $commentId;

            print_r($post);

            $this->postService->updatePost($commentData["postId"], $post);
        }
        return $this->commentRepository->readById($result->getInsertedId());
    }

    public function getCommentsByPostId(string $postId): array {
        return $this->commentRepository->findByPostId($postId);
    }

    public function updateComment(string $commentId, array $newData): int {
        $newData['updatedAt'] = new UTCDateTime();
        return $this->commentRepository->update($commentId, $newData);
    }

    public function deleteComment(string $commentId): int {
        $comment = $this->commentRepository->readById($commentId);
        if ($comment) {
            $result = $this->commentRepository->delete($commentId);
            if ($result) {
                // Remove comment from the post
                $this->postService->removeCommentFromPost((string)$comment->postId, $commentId);
            }
            return $result;
        }
        return 0;
    }

    public function getAllComments(): array {
        return $this->commentRepository->readAll();
    }
}
