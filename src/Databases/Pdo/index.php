<?php

require_once 'Actions/Create.php';
require_once 'Actions/Delete.php';
require_once 'Actions/Read.php';
require_once 'Actions/Update.php';
require_once 'Actions/Setup.php';


function displayEntity($entity, $type)
{
    if ($entity) {
        echo "$type ID: {$entity['id']}, ";

        switch ($type) {
            case 'User':
                echo "Name: {$entity['name']}, Email: {$entity['email']}" . PHP_EOL;
                break;
            case 'Document':
                echo "DNI: {$entity['dni']}, User ID: {$entity['user_id']}" . PHP_EOL;
                break;
            case 'Post':
                echo "Name: {$entity['name']}, Text: {$entity['text']}, User ID: {$entity['user_id']}" . PHP_EOL;
                break;
        }
    } else {
        echo "$type not found." . PHP_EOL;
    }
}


function create(Create $creator): void
{
    $users = [
        [
            "name" => "John Doe",
            "email" => "john.doe@example.com",
            "document" => "45789123A",
            "posts" => [
                ["name" => "Transform", "text" => "Creative Spaces"],
                ["name" => "Growth", "text" => "Healthy Habits"],
                ["name" => "Innovate", "text" => "Mindful Living"],
            ],
        ],
        [
            "name" => "Mike Doe",
            "email" => "mike.doe@example.com",
            "document" => "12456789S",
            "posts" => [
                ["name" => "Nourish", "text" => "Future Trends"],
                ["name" => "Simplify", "text" => "Quiet Moments"],
            ],
        ],
        [
            "name" => "Jane Doe",
            "email" => "jane.doe@example.com",
            "document" => "78456123D",
            "posts" => [
                ["name" => "Balance", "text" => "Bold Choices"],
            ],
        ],
    ];


    foreach ($users as $user) {
        $user_id = $creator->insertData("user", ["name" => $user["name"], "email" => $user["email"]]);
        $creator->insertData("document", ["dni" => $user["document"], "user_id" => $user_id]);

        foreach ($user["posts"] as $post) {
            $creator->insertData("post", ["name" => $post["name"], "text" => $post["text"], "user_id" => $user_id]);
        }
    }
}

function read(Read $reader): void
{
    $entities = [
        'user' => 'User',
        'document' => 'Document',
        'post' => 'Post',
    ];

    foreach ($entities as $tableName => $entityType) {
        $entities = $reader->getAll($tableName);
        foreach ($entities as $entity) {
            displayEntity($entity, $entityType);
        }

        // Get a single entity by ID
        $entity = $reader->getById($tableName, 1);
        displayEntity($entity, $entityType);
    }

    echo PHP_EOL . "==========================" . PHP_EOL . PHP_EOL;
}

function update(Update $updater, Read $reader): void
{
    $userUpdateData = [
        'email' => 'jane.doeeeeeeeeeeee83@example.com'
    ];

    $user = $reader->getByField('user', 'email', "jane.doe@example.com");
    $userId = $user['id'];

    $rowsAffected = $updater->updateById('User', $userId, $userUpdateData);

    if ($rowsAffected) {
        echo "Updated {$rowsAffected} row(s)." . PHP_EOL;
    } else {
        echo "No rows updated or error occurred." . PHP_EOL;
    }
}

function delete(Delete $deleter): void
{
    $userId = 1;
    $rowsAffected = $deleter->deleteById('User', $userId);

    if ($rowsAffected) {
        echo "Deleted {$rowsAffected} row(s)." . PHP_EOL;
    } else {
        echo "No rows deleted or error occurred." . PHP_EOL;
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

        create($creator, $reader);

        read($reader);

        update($updater, $reader);

        read($reader);

        delete($deleter);

        read($reader);

    } else {
        echo "Execution finished with ERROR" . PHP_EOL;
    }
}

main();