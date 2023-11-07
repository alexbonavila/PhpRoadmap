<?php

namespace Postgres\Src\Database\Migrations;

/**
 * The CreateTeachersClassesTable class provides methods to create and drop the 'teachers_classes' table.
 * This table is used to establish a many-to-many relationship between 'teachers' and 'classes' tables.
 */
class CreateTeachersClassesTable
{
    /**
     * Creates the 'teachers_classes' table in the database.
     * This method executes a SQL statement to create a junction table with 'teacher_id' and 'class_id' as composite primary keys.
     * It also defines the foreign keys for 'teacher_id' and 'class_id', with cascade delete behavior.
     *
     * @param mixed $connection The database connection resource.
     * @return void
     */
    public static function up(mixed $connection): void
    {
        $query = "CREATE TABLE teachers_classes (
            teacher_id INT NOT NULL, 
            class_id INT NOT NULL, 
            PRIMARY KEY (teacher_id, class_id), 
            FOREIGN KEY (teacher_id) REFERENCES teachers(id) ON DELETE CASCADE, 
            FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE
        );";

        $result = pg_query($connection, $query);

        if ($result) {
            echo "Table 'teachers_classes' created properly." . PHP_EOL;
        } else {
            echo "Error creating table 'teachers_classes': " . pg_last_error($connection) . PHP_EOL;
        }
    }

    /**
     * Drops the 'teachers_classes' table from the database if it exists.
     * This method executes a SQL statement to remove the junction table, thus disassociating 'teachers' from 'classes'.
     *
     * @param mixed $connection The database connection resource.
     * @return void
     */
    public static function down(mixed $connection): void
    {
        $query = "DROP TABLE IF EXISTS teachers_classes;";

        $result = pg_query($connection, $query);

        if ($result) {
            echo "Table 'teachers_classes' deleted properly." . PHP_EOL;
        } else {
            echo "Error deleting table 'teachers_classes': " . pg_last_error($connection) . PHP_EOL;
        }
    }
}
