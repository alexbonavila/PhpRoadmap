<?php

namespace Postgres\Src\Database\Migrations;

/**
 * The CreateClassesTable class contains methods to handle the creation and deletion of the 'classes' table in the database.
 */
class CreateClassesTable
{
    /**
     * Creates the 'classes' table in the database.
     * The 'up' method executes a SQL statement to create a table with 'id', 'code', and 'name' columns.
     *
     * @param mixed $connection The database connection resource.
     * @return void
     */
    public static function up(mixed $connection): void
    {
        $query = "CREATE TABLE classes (
            id SERIAL PRIMARY KEY, 
            code VARCHAR(255) UNIQUE NOT NULL, 
            name VARCHAR(255) NOT NULL
        );";

        $result = pg_query($connection, $query);

        if ($result) {
            echo "Table 'classes' created properly." . PHP_EOL;
        } else {
            echo "Error creating table 'classes': " . pg_last_error($connection) . PHP_EOL;
        }
    }

    /**
     * Deletes the 'classes' table from the database if it exists.
     * The 'down' method executes a SQL statement to drop the 'classes' table.
     *
     * @param mixed $connection The database connection resource.
     * @return void
     */
    public static function down(mixed $connection): void
    {
        $query = "DROP TABLE IF EXISTS classes;";

        $result = pg_query($connection, $query);

        if ($result) {
            echo "Table 'classes' deleted properly." . PHP_EOL;
        } else {
            echo "Error deleting table 'classes': " . pg_last_error($connection) . PHP_EOL;
        }
    }
}
