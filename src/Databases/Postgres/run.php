<?php

// Define route base
$GLOBALS['baseProject'] = __DIR__;

// Load configuration
require_once __DIR__ . '/Src/Config/config.php';

// Load namespaces structure
require_once __DIR__ . '/Src/Config/bootstrap.php';

use Postgres\Cli\CliHandler;
use Postgres\Src\Database\Connection;
use Postgres\Src\Database\Migrations\CreateClassesTable;
use Postgres\Src\Database\Migrations\CreateTeachersClassesTable;
use Postgres\Src\Database\Migrations\CreateTeachersTable;

if ($argc > 1) {
    // Establish the connection with the Database
    $connection = Connection::getConnection();

    // Execution control
    switch ($argv[1]) {
        case 'migrate_refresh':
            CreateTeachersClassesTable::down($connection);
            CreateClassesTable::down($connection);
            CreateTeachersTable::down($connection);

            CreateTeachersTable::up($connection);
            CreateClassesTable::up($connection);
            CreateTeachersClassesTable::up($connection);
            break;

        case 'run_cli':
            $cliHandler = new CliHandler($connection);
            $cliHandler->handle();
            break;

        default:
            echo "Parameter incorrect." . PHP_EOL;
            break;
    }
} else {
    echo "Parameter incorrect." . PHP_EOL;
}
