<?php

namespace Postgres\Src\Models;

use PgSql\Result;
use Postgres\Src\Database\QueryBuilder;

/**
 * The ClassModel provides an abstraction layer to access the 'classes' table data.
 * It uses QueryBuilder to interact with the database.
 */
class ClassModel
{
    /**
     * The QueryBuilder instance to perform database operations.
     *
     * @var QueryBuilder
     */
    private QueryBuilder $queryBuilder;

    /**
     * Class constructor.
     * Initializes a new instance of the QueryBuilder with the provided database connection.
     *
     * @param mixed $connection The PostgreSQL database connection resource.
     */
    public function __construct(mixed $connection) {
        $this->queryBuilder = new QueryBuilder($connection);
    }

    /**
     * Retrieves a single class record by its unique identifier.
     *
     * @param int $id The unique identifier of the class to find.
     * @return false|array An associative array of the class record, or false on failure.
     */
    public function find(int $id): false|array
    {
        $result = $this->queryBuilder->select('classes', '*', "id = $id");

        return pg_fetch_assoc($result);
    }

    /**
     * Retrieves all class records from the 'classes' table.
     *
     * @return array An array of associative arrays, each representing a class record.
     */
    public function all(): array
    {
        $result =  $this->queryBuilder->select('classes');

        $classes = [];
        while ($row = pg_fetch_assoc($result)) {
            $classes[] = $row;
        }

        return $classes;
    }

    /**
     * Inserts a new class record into the 'classes' table.
     *
     * @param array $data An associative array containing the class data to be inserted.
     * @return Result|false The result of the insert operation, or false on failure.
     */
    public function create(array $data): Result|false
    {
        return $this->queryBuilder->insert('classes', $data);
    }

    /**
     * Updates an existing class record in the 'classes' table.
     *
     * @param int $id The unique identifier of the class to be updated.
     * @param array $data An associative array containing the class data to be updated.
     * @return Result|false The result of the update operation, or false on failure.
     */
    public function update(int $id, array $data): Result|false
    {
        return $this->queryBuilder->update('classes', $data, ['id' => $id]);
    }

    /**
     * Deletes a class record from the 'classes' table.
     *
     * @param int $id The unique identifier of the class to be deleted.
     * @return Result|false The result of the delete operation, or false on failure.
     */
    public function delete(int $id): Result|false
    {
        return $this->queryBuilder->delete('classes', ['id' => $id]);
    }
}
