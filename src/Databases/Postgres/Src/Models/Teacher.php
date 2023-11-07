<?php

namespace Postgres\Src\Models;

use PgSql\Result;
use Postgres\Src\Database\QueryBuilder;

/**
 * The Teacher class provides methods for CRUD operations on the 'teachers' table.
 */
class Teacher
{
    /**
     * Instance of QueryBuilder for database operations.
     *
     * @var QueryBuilder
     */
    private QueryBuilder $queryBuilder;

    /**
     * Teacher constructor initializes QueryBuilder with a database connection.
     *
     * @param mixed $connection Database connection resource.
     */
    public function __construct(mixed $connection) {
        $this->queryBuilder = new QueryBuilder($connection);
    }

    /**
     * Find a teacher by ID.
     *
     * @param int $id The unique identifier for the teacher.
     * @return false|array Teacher data as an associative array, or false if not found.
     */
    public function find(int $id): false|array
    {
        $result = $this->queryBuilder->select('teachers', '*', "id = $id");

        return pg_fetch_assoc($result);
    }

    /**
     * Retrieve all teachers.
     *
     * @return array An array of all teacher records.
     */
    public function all(): array
    {
        $result = $this->queryBuilder->select('teachers');

        $teachers = [];
        while ($row = pg_fetch_assoc($result)) {
            $teachers[] = $row;
        }

        return $teachers;
    }

    /**
     * Create a new teacher record.
     *
     * @param array $data Data for the new teacher.
     * @return Result|false The result of the insert operation, or false on failure.
     */
    public function create(array $data): Result|false
    {
        return $this->queryBuilder->insert('teachers', $data);
    }

    /**
     * Update an existing teacher record.
     *
     * @param int $id The ID of the teacher to update.
     * @param array $data The data to update in the teacher's record.
     * @return Result|false The result of the update operation, or false on failure.
     */
    public function update(int $id, array $data): Result|false
    {
        return $this->queryBuilder->update('teachers', $data, ['id' => $id]);
    }

    /**
     * Delete a teacher by ID.
     *
     * @param int $id The ID of the teacher to delete.
     * @return Result|false The result of the delete operation, or false on failure.
     */
    public function delete(int $id): Result|false
    {
        return $this->queryBuilder->delete('teachers', ['id' => $id]);
    }
}
