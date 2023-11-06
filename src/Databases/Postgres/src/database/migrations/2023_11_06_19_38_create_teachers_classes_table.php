<?php

class CreateTeachersClassesTable
{
    public static function up($connection)
    {
        $query = "CREATE TABLE teachers_classes (teacher_id INT NOT NULL, class_id INT NOT NULL, PRIMARY KEY (teacher_id, class_id), FOREIGN KEY (teacher_id) REFERENCES teachers(id) ON DELETE CASCADE, FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE);";

        $result = pg_query($connection, $query);

        if ($result)
        {
            echo "Tabla 'teachers_classes' creada correctamente.\n";
        } else {
            echo "Error al crear la tabla 'teachers_classes': " . pg_last_error($connection) . "\n";
        }
    }

    public static function down($connection)
    {
        $query = "DROP TABLE IF EXISTS teachers_classes;";

        $result = pg_query($connection, $query);

        if ($result) {
            echo "Tabla 'teachers_classes' eliminada correctamente.\n";
        } else {
            echo "Error al eliminar la tabla 'teachers_classes': " . pg_last_error($connection) . "\n";
        }
    }
}