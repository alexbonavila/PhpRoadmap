<?php

class CreateClassesTable
{
    public static function up($connection)
    {
        $query = "CREATE TABLE classes (id SERIAL PRIMARY KEY, code VARCHAR(255) UNIQUE NOT NULL, name VARCHAR(255) NOT NULL);";

        $result = pg_query($connection, $query);

        if ($result)
        {
            echo "Tabla 'classes' created properly." . PHP_EOL;
        } else {
            echo "Error creating table 'classes': " . pg_last_error($connection) . PHP_EOL;
        }
    }

    public static function down($connection)
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