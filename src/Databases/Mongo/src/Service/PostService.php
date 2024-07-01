<?php

namespace App\Service;

use App\Model\Post;
use App\Repository\PostRepository;
use MongoDB\BSON\UTCDateTime;

class PostService {
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository) {
        $this->postRepository = $postRepository;
    }

    public function createPost(Post $post): Post
    {
        $result = $this->postRepository->create($post->toArray());

        $post->mapObject($this->postRepository->readById($result->getInsertedId()));

        return $post;
    }

    public function getPostsByUserId(string $userId): array
    {
        $posts = [];
        $posts_raw = $this->postRepository->findByUserId($userId);

        foreach ($posts_raw as $rPost) {
            $post = new Post();
            $post->mapObject($rPost);
            $posts[] = $post;
        }

        return $posts;
    }

    public function getPostById(string $postId): Post
    {
        $post = new Post();
        $post->mapObject($this->postRepository->readById($postId));
        return $post;
    }

    public function updatePost(string $postId, array $newData): int {
        $newData['updatedAt'] = new UTCDateTime();
        return $this->postRepository->update($postId, $newData);
    }

    public function deletePost(string $postId): int {
        return $this->postRepository->delete($postId);
    }

    public function getAllPosts(): array {
        $posts = [];
        $posts_raw = $this->postRepository->readAll();

        foreach ($posts_raw as $rPost) {
            $post = new Post();
            $post->mapObject($rPost);
            $posts[] = $post;
        }

        return $posts;
    }

    public function addComment(string $postId, string $commentId): void
    {
        $post = $this->getPostById($postId);
        $post->addComment($commentId);

        $this->updatePost($postId, $post->toArray());
    }

    public function removeComment(string $postId, string $commentId): void
    {
        $post = $this->getPostById($postId);

        print_r($commentId);

        $post->removeComment($commentId);

        $this->updatePost($postId, $post->toArray());
    }
}
