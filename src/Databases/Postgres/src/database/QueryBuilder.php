<?php

class QueryBuilder
{
    protected $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function select($table, $columns = '*'): \PgSql\Result|false
    {
        $query = "SELECT {$columns} FROM {$table};";
        return pg_query($this->connection, $query);
    }

    public function insert($table, $data)
    {
        $keys = implode(", ", array_keys($data));
        $values = implode(", ", array_map(function ($value) {
            return "'" . pg_escape_string($value) . "'";
        }, array_values($data)));

        $query = "INSERT INTO {$table} ({$keys}) VALUES ({$values});";
        return pg_query($this->connection, $query);
    }

    public function update($table, $data, $conditions)
    {
        $updates = implode(", ", array_map(function ($value, $key) {
            return "{$key} = '" . pg_escape_string($value) . "'";
        }, array_values($data), array_keys($data)));

        $where = implode(" AND ", array_map(function ($value, $key) {
            return "{$key} = '" . pg_escape_string($value) . "'";
        }, array_values($conditions), array_keys($conditions)));

        $query = "UPDATE {$table} SET {$updates} WHERE {$where};";
        return pg_query($this->connection, $query);
    }

    public function delete($table, $conditions)
    {
        $where = implode(" AND ", array_map(function ($value, $key) {
            return "{$key} = '" . pg_escape_string($value) . "'";
        }, array_values($conditions), array_keys($conditions)));

        $query = "DELETE FROM {$table} WHERE {$where};";
        return pg_query($this->connection, $query);
    }

    public function rawQuery($sql)
    {
        $result = pg_query($this->connection, $sql);

        if (!$result) {
            throw new Exception('Error en la consulta SQL: ' . pg_last_error($this->connection));
        }

        $rows = [];
        while ($row = pg_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }
}