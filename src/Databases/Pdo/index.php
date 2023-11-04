<?php

require_once 'Actions/Create.php';
require_once 'Actions/Delete.php';
require_once 'Actions/Read.php';
require_once 'Actions/Update.php';
require_once 'Actions/Setup.php';


function create(Create $creator): void
{
    $userData = [
        'name' => 'John Doe',
        'email' => 'john.doe@example.com'
    ];

    $userId = $creator->insertData('user', $userData);

    if ($userId) {
        echo "Inserted user with ID: $userId" . PHP_EOL;
    } else {
        echo "Failed to insert user" . PHP_EOL;
    }
}

function read(Read $reader): void
{
    // Get all users
    $users = $reader->getAll('user');
    foreach ($users as $user) {
        echo 'User ID: ' . $user['id'] . ', Name: ' . $user['name'] . ', Email: ' . $user['email'] . PHP_EOL;
    }

    // Get a single user by ID
    $user = $reader->getById('user', 1);
    if ($user) {
        echo 'User ID: ' . $user['id'] . ', Name: ' . $user['name'] . ', Email: ' . $user['email'] . PHP_EOL;
    } else {
        echo "User not found.";
    }

    // Get a single user by email
    $user = $reader->getByField('user', 'email', "john.doe@example.com");
    if ($user) {
        echo 'User ID: ' . $user['id'] . ', Name: ' . $user['name'] . ', Email: ' . $user['email'] . PHP_EOL;
    } else {
        echo "User not found.";
    }
}


function main(): void
{
    $setup = new Setup();
    $pdo = $setup->index();

    if ($pdo != NULL) {
        $creator = new Create($pdo);
        $deleter = new Delete($pdo);
        $reader = new Read($pdo);
        $updater = new Update($pdo);

        create($creator);

        read($reader);


    } else {
        echo "Execution finished with ERROR" . PHP_EOL;
    }
}

main();