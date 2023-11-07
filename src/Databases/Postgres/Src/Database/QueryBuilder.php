<?php

namespace Postgres\Src\Database;

use Exception;
use PgSql\Result;
use PgSql\Connection;

/**
 * The QueryBuilder class provides an interface to build and execute SQL queries.
 */
class QueryBuilder
{
    /**
     * The database connection resource.
     *
     * @var Connection
     */
    protected Connection $connection;

    /**
     * QueryBuilder constructor to set up the database connection.
     *
     * @param Connection $connection The database connection resource.
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Executes a SELECT query on the given table.
     *
     * @param string $table The name of the table to select from.
     * @param string $columns The columns to select, defaults to all (*).
     * @return Result|false   Returns a Result object on success, or false on failure.
     */
    public function select(string $table, string $columns = '*'): Result|false
    {
        $query = "SELECT $columns FROM $table;";
        return pg_query($this->connection, $query);
    }

    /**
     * Executes an INSERT query on the given table with the specified data.
     *
     * @param string $table The name of the table to insert into.
     * @param array $data An associative array of column => value pairs.
     * @return Result|false Returns a Result object on success, or false on failure.
     */
    public function insert(string $table, array $data): Result|false
    {
        $keys = implode(", ", array_keys($data));
        $values = implode(", ", array_map(function ($value) {
            return "'" . pg_escape_string($value) . "'";
        }, array_values($data)));

        $query = "INSERT INTO $table ($keys) VALUES ($values);";
        return pg_query($this->connection, $query);
    }

    /**
     * Executes an UPDATE query on the given table with the specified data and conditions.
     *
     * @param string $table The name of the table to update.
     * @param array $data An associative array of column => value pairs to update.
     * @param array $conditions An associative array of column => value pairs for the conditions.
     * @return Result|false       Returns a Result object on success, or false on failure.
     */
    public function update(string $table, array $data, array $conditions): Result|false
    {
        $updates = implode(", ", array_map(function ($value, $key) {
            return "$key = '" . pg_escape_string($value) . "'";
        }, array_values($data), array_keys($data)));

        $where = implode(" AND ", array_map(function ($value, $key) {
            return "$key = '" . pg_escape_string($value) . "'";
        }, array_values($conditions), array_keys($conditions)));

        $query = "UPDATE $table SET $updates WHERE $where;";
        return pg_query($this->connection, $query);
    }

    /**
     * Executes a DELETE query on the given table with the specified conditions.
     *
     * @param string $table The name of the table to delete from.
     * @param array $conditions An associative array of column => value pairs for the conditions.
     * @return Result|false      Returns a Result object on success, or false on failure.
     */
    public function delete(string $table, array $conditions): Result|false
    {
        $where = implode(" AND ", array_map(function ($value, $key) {
            return "$key = '" . pg_escape_string($value) . "'";
        }, array_values($conditions), array_keys($conditions)));

        $query = "DELETE FROM $table WHERE $where;";
        return pg_query($this->connection, $query);
    }

    /**
     * Executes a raw SQL query and returns the result as an associative array.
     *
     * @param string $sql The raw SQL query to execute.
     * @return array      An array of associative arrays representing the result set.
     * @throws Exception  Throws an exception if the SQL query fails.
     */
    public function rawQuery(string $sql): array
    {
        $result = pg_query($this->connection, $sql);

        if (!$result) {
            throw new Exception('Error in SQL query: ' . pg_last_error($this->connection));
        }

        $rows = [];
        while ($row = pg_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }
}
