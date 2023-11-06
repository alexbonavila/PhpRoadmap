<?php

class CreateTeachersTable
{
    public static function up($connection)
    {
        $query = "CREATE TABLE teachers (id SERIAL PRIMARY KEY, dni VARCHAR(255) UNIQUE NOT NULL, name VARCHAR(255) NOT NULL);";

        $result = pg_query($connection, $query);

        if ($result)
        {
            echo "Tabla 'teachers' creada correctamente.\n";
        } else {
            echo "Error al crear la tabla 'teachers': " . pg_last_error($connection) . "\n";
        }
    }

    public static function down($connection)
    {
        $query = "DROP TABLE IF EXISTS teachers;";

        $result = pg_query($connection, $query);

        if ($result) {
            echo "Tabla 'teachers' eliminada correctamente.\n";
        } else {
            echo "Error al eliminar la tabla 'teachers': " . pg_last_error($connection) . "\n";
        }
    }
}
