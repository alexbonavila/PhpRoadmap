<?php

namespace App\Service;

use App\Model\Comment;
use App\Repository\CommentRepository;
use MongoDB\BSON\UTCDateTime;

class CommentService {
    private CommentRepository $commentRepository;
    private PostService $postService;

    public function __construct(CommentRepository $commentRepository, PostService $postService) {
        $this->commentRepository = $commentRepository;
        $this->postService = $postService;
    }

    public function createComment(Comment $comment): Comment
    {
        $result = $this->commentRepository->create($comment->toArray());

        $comment->mapObject($this->commentRepository->readById($result->getInsertedId()));

        $this->postService->addComment($comment->postId, $comment->id);

        return $comment;
    }

    public function getCommentById(string $commentId): Comment
    {
        $comment = new Comment();
        $comment->mapObject($this->commentRepository->readById($commentId));
        return $comment;
    }

    public function getCommentsByPostId(string $postId): array {
        $comments = [];
        $comments_raw = $this->commentRepository->findByPostId($postId);

        foreach ($comments_raw as $rComment) {
            $comment = new Comment();
            $comment->mapObject($rComment);
            $comments[] = $comment;
        }

        return $comments;
    }

    public function getAllComments(): array {
        $comments = [];
        $comments_raw = $this->commentRepository->readAll();

        foreach ($comments_raw as $rComment) {
            $comment = new Comment();
            $comment->mapObject($rComment);
            $comments[] = $comment;
        }

        return $comments;
    }

    public function updateComment(string $commentId, array $newData): int {
        $newData['updatedAt'] = new UTCDateTime();
        return $this->commentRepository->update($commentId, $newData);
    }

    public function deleteComment(string $commentId): int {
        $comment = $this->commentRepository->readById($commentId);

        $this->postService->removeComment($comment->postId, $commentId);

        return $this->commentRepository->delete($commentId);
    }
}
