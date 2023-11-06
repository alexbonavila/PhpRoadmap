<?php

require './bootstrap.php';

$connection = Connection::getConnection();
$query = "CREATE TABLE teachers (
    id SERIAL PRIMARY KEY,
    dni VARCHAR(255) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL
);";

$result = pg_query($connection, $query);

if ($result) {
    echo "Tabla 'teachers' creada correctamente.";
} else {
    echo "Error al crear la tabla 'teachers': " . pg_last_error($connection);
}

pg_close($connection);
