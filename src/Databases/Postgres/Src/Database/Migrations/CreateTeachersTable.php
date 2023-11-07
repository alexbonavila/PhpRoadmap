<?php

namespace Postgres\Src\Database\Migrations;

/**
 * The CreateTeachersTable class contains methods to handle the creation and deletion of the 'teachers' table in the database.
 * This class is part of the database migration system.
 */
class CreateTeachersTable
{
    /**
     * Executes the SQL command to create the 'teachers' table with the necessary fields.
     * The table is structured with 'id' as a SERIAL PRIMARY KEY, 'dni' as a UNIQUE field, and 'name'.
     * If the creation is successful, a confirmation message is printed.
     * If there is an error, the error message from the database is printed.
     *
     * @param mixed $connection The PostgreSQL database connection resource.
     * @return void
     */
    public static function up(mixed $connection): void
    {
        $query = "CREATE TABLE teachers (
            id SERIAL PRIMARY KEY, 
            dni VARCHAR(255) UNIQUE NOT NULL, 
            name VARCHAR(255) NOT NULL
        );";

        $result = pg_query($connection, $query);

        if ($result) {
            echo "Table 'teachers' created properly." . PHP_EOL;
        } else {
            echo "Error creating table 'teachers': " . pg_last_error($connection) . PHP_EOL;
        }
    }

    /**
     * Executes the SQL command to drop the 'teachers' table if it exists.
     * This method is part of the rollback mechanism of the migration system, allowing the database to revert to a previous state.
     * A success message is printed if the table is deleted, otherwise an error message is displayed.
     *
     * @param mixed $connection The PostgreSQL database connection resource.
     * @return void
     */
    public static function down(mixed $connection): void
    {
        $query = "DROP TABLE IF EXISTS teachers;";

        $result = pg_query($connection, $query);

        if ($result) {
            echo "Table 'teachers' deleted properly." . PHP_EOL;
        } else {
            echo "Error deleting table 'teachers': " . pg_last_error($connection) . PHP_EOL;
        }
    }
}
