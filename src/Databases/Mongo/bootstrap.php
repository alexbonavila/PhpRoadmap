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
    // Create a new user
    $user = new User('jane_doe', 'jane@example.com', password_hash('password123', PASSWORD_BCRYPT));
    $userService->createUser([
        'username' => $user->getUsername(),
        'email' => $user->getEmail(),
        'password' => $user->getPassword(),
        'createdAt' => $user->getCreatedAt(),
        'updatedAt' => $user->getUpdatedAt(),
    ]);

    // Retrieve the user by email
    $user = $userService->getUserByEmail('jane@example.com');
    echo "User created: \n";
    print_r($user);

    // Ensure user creation was successful
    if (!$user) {
        throw new Exception("User creation failed.");
    }

    // Create a new post
    $post = new Post((string) $user->_id, 'My First Post', 'This is the content of my first post.');
    $postService->createPost([
        'userId' => $post->getUserId(),
        'title' => $post->getTitle(),
        'content' => $post->getContent(),
        'createdAt' => $post->getCreatedAt(),
        'updatedAt' => $post->getUpdatedAt(),
        'comments' => $post->getComments()
    ]);

    // Retrieve posts by user ID
    $posts = $postService->getPostsByUserId((string) $user->_id);
    echo "Posts by user: \n";
    print_r($posts);

    // Ensure posts retrieval was successful
    if (empty($posts)) {
        throw new Exception("No posts found for user.");
    }

    // Create a new comment
    $comment = new Comment((string) $posts[0]->_id, (string) $user->_id, 'This is a comment.');
    $commentService->createComment([
        'postId' => $comment->getPostId(),
        'userId' => $comment->getUserId(),
        'content' => $comment->getContent(),
        'createdAt' => $comment->getCreatedAt(),
        'updatedAt' => $comment->getUpdatedAt()
    ]);

    // Retrieve comments by post ID
    $comments = $commentService->getCommentsByPostId((string) $posts[0]->_id);
    echo "Comments on post: \n";
    print_r($comments);

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}


