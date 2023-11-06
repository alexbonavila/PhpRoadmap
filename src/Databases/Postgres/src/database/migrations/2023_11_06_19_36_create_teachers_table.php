<?php

class CreateTeachersTable
{
    public static function up($connection)
    {
        $query = "CREATE TABLE teachers (id SERIAL PRIMARY KEY, dni VARCHAR(255) UNIQUE NOT NULL, name VARCHAR(255) NOT NULL);";

        $result = pg_query($connection, $query);

        if ($result)
        {
            echo "Table 'teachers' created properly." . PHP_EOL;
        } else {
            echo "Error creating table 'teachers': " . pg_last_error($connection) . PHP_EOL;
        }
    }

    public static function down($connection)
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
