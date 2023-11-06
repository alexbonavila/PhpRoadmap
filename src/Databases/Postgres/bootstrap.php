<?php

if ($argc > 1) {

    // Define route base
    $GLOBALS['baseProject'] = __DIR__;

    // Load configuration
    require_once __DIR__ . '/src/config/config.php';

    // Establish the connection with the database
    require_once __DIR__ . '/src/database/Connection.php';
    $connection = Connection::getConnection();

    // Execution control
    switch ($argv[1]){
        case 'migrate_refresh':
            // Migrate Database TODO Refactor this code
            require_once __DIR__ . '/src/database/migrations/2023_11_06_19_35_create_classes_table.php';
            require_once __DIR__ . '/src/database/migrations/2023_11_06_19_36_create_teachers_table.php';
            require_once __DIR__ . '/src/database/migrations/2023_11_06_19_38_create_teachers_classes_table.php';

            CreateTeachersClassesTable::down($connection);
            CreateClassesTable::down($connection);
            CreateTeachersTable::down($connection);

            CreateTeachersTable::up($connection);
            CreateClassesTable::up($connection);
            CreateTeachersClassesTable::up($connection);
            break;

        case 'run_cli':
            echo "Run cli";
            break;

        default:
            echo "Parameter incorrect." . PHP_EOL;
            break;
    }
} else {
    echo "Parameter incorrect." . PHP_EOL;
}
