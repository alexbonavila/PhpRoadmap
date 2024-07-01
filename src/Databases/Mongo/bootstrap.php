<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Repository\UserRepository;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use App\Service\UserService;
use App\Service\PostService;
use App\Service\CommentService;
use Dotenv\Dotenv;
use App\Config\Database;
use App\Model\User;
use App\Model\Post;
use App\Model\Comment;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

Database::initialize();

$mongoClient = Database::getClient();

// Initialize repositories and services
$userRepository = new UserRepository($mongoClient);
$postRepository = new PostRepository($mongoClient);
$commentRepository = new CommentRepository($mongoClient);

$userService = new UserService($userRepository);
$postService = new PostService($postRepository);
$commentService = new CommentService($commentRepository, $postService);



// Example data for testing
try {
    //=============//
    /* USER DEMONSTRATION */
    //=============//
    // Create a new user
    $user = new User();
    $user->username = 'jane_doe';
    $user->email = 'jane@example.com';
    $user->password = password_hash('password123', PASSWORD_BCRYPT);
    $user = $userService->createUser($user);

    // Read user by email
    $user = $userService->getUserByEmail($user->email);
    print_r($user);

    // Update user email
    $user->email = 'jane@gmail.com';
    $userService->updateUser($user->id, $user->toArray());

    $user = $userService->getUserByEmail($user->email);
    print_r($user);

    // Delete user
    $userService->deleteUser($user->id);

    // List all users
    $user = new User();
    $user->username = 'john_doe';
    $user->email = 'john@example.com';
    $user->password = password_hash('password123', PASSWORD_BCRYPT);
    $user = $userService->createUser($user);

    $user = new User();
    $user->username = 'mary_doe';
    $user->email = 'mary@example.com';
    $user->password = password_hash('password123', PASSWORD_BCRYPT);
    $user = $userService->createUser($user);

    print_r($userService->getAllUsers());

    $user = $userService->getUserByEmail("mary@example.com");


    //=============//
    /* POST DEMONSTRATION */
    //=============//
    // Create a new post
    $post = new Post();
    $post->userId = $user->id;
    $post->title = "First Post";
    $post->content = "Content of first post";
    $post = $postService->createPost($post);

    // Find post by user id
    print_r($postService->getPostsByUserId($user->id));

    // Find post by id
    print_r($postService->getPostById($post->id));

    // Update post
    $post->content = "Content of first post modified";
    $postService->updatePost($post->id, $post->toArray());

    // Delete post
    $postService->deletePost($post->id);

    // List all posts
    $post = new Post();
    $post->userId = $user->id;
    $post->title = "Second Post";
    $post->content = "Content of second post";
    $post = $postService->createPost($post);

    $post = new Post();
    $post->userId = $user->id;
    $post->title = "Third Post";
    $post->content = "Content of third post";
    $post = $postService->createPost($post);

    print_r($postService->getAllPosts());


    //=============//
    /* COMMENT DEMONSTRATION */
    //=============//
    // Create a new comment
    $comment = new Comment();
    $comment->userId = $user->id;
    $comment->postId = $post->id;
    $comment->content = "Content of comment";
    $comment = $commentService->createComment($comment);

    // Find comment by post id
    print_r($commentService->getCommentsByPostId($post->id));

    // Find comment by id
    print_r($commentService->getCommentById($comment->id));

    // Update comment
    $comment->content = "Content of comment modified";
    $commentService->updateComment($comment->id, $comment->toArray());

    // Delete comment
    $commentService->deleteComment($comment->id);

    // List all comments
    $comment = new Comment();
    $comment->userId = $user->id;
    $comment->postId = $post->id;
    $comment->content = "Content of comment 2";
    $comment = $commentService->createComment($comment);

    $comment = new Comment();
    $comment->userId = $user->id;
    $comment->postId = $post->id;
    $comment->content = "Content of comment 3";
    $comment = $commentService->createComment($comment);

    print_r($commentService->getAllComments());

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}


