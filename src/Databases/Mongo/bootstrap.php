<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Repository\UserRepository;
use App\Service\UserService;
use Dotenv\Dotenv;
use App\Config\Database;


// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

Database::initialize();

$mongoClient = Database::getClient();

$userService = new UserService(new UserRepository($mongoClient));

$userData = [
    'dni' => '12345678Z',
    'name' => 'John Doe',
];

if ($userService->createUser($userData)) {
    echo "Usuario creado con éxito.\n";
} else {
    echo "Error al crear el usuario.\n";
}