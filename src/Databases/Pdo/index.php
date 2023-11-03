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


function main(): void
{
    $setup = new Setup();
    $pdo = $setup->index();

    if ($pdo != NULL) {
        $creator = new Create($pdo);
        $delete = new Delete($pdo);
        $read = new Read($pdo);
        $update = new Update($pdo);

        create($creator);


    } else {
        echo "Execution finished with ERROR" . PHP_EOL;
    }
}

main();