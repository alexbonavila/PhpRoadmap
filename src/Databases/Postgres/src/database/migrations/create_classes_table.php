<?php

require '../../../bootstrap.php';

$connection = Connection::getConnection();
$query = "CREATE TABLE classes (
    id SERIAL PRIMARY KEY,
    code VARCHAR(255) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL
);";

$result = pg_query($connection, $query);

if ($result) {
    echo "Tabla 'classes' creada correctamente.\n";
} else {
    echo "Error al crear la tabla 'classes': " . pg_last_error($connection) . "\n";
}

pg_close($connection);
