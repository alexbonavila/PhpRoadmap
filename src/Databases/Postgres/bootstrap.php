<?php

// Define route base
$GLOBALS['baseProject'] = __DIR__;

// Load configuration
require_once __DIR__ . '/src/config/config.php';

// Establish the connection with the database
require_once __DIR__ . '/src/database/Connection.php';
$connection = Connection::getConnection();

// Migrate Database (Move code in future)
require_once __DIR__ . '/src/database/migrations/2023_11_06_19_35_create_classes_table.php';
require_once __DIR__ . '/src/database/migrations/2023_11_06_19_36_create_teachers_table.php';
require_once __DIR__ . '/src/database/migrations/2023_11_06_19_38_create_teachers_classes_table.php';

CreateTeachersTable::down($connection);
CreateTeachersTable::up($connection);

CreateClassesTable::down($connection);
CreateClassesTable::up($connection);

CreateTeachersClassesTable::down($connection);
CreateTeachersClassesTable::up($connection);
