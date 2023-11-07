<?php

namespace Postgres\Src\Services;

use InvalidArgumentException;
use PgSql\Result;
use Postgres\Src\Models\Teacher;

/**
 * TeacherService provides a layer of business logic to interact with Teacher data.
 */
class TeacherService {
    /**
     * Instance of the Teacher model for database interactions.
     *
     * @var Teacher
     */
    private Teacher $teacher;

    /**
     * TeacherService constructor to initialize with a database connection.
     *
     * @param mixed $connection The database connection resource.
     */
    public function __construct(mixed $connection) {
        $this->teacher = new Teacher($connection);
    }

    /**
     * Creates a new teacher record in the database.
     *
     * @param array $data Associative array of teacher data ('dni', 'name').
     * @return Result|false The result of the create operation or false on failure.
     * @throws InvalidArgumentException If required data elements are missing.
     */
    public function create(array $data): Result|false
    {
        if (empty($data['dni']) || empty($data['name'])) {
            throw new InvalidArgumentException('DNI and name are mandatory.');
        }
        return $this->teacher->create($data);
    }

    /**
     * Retrieves all teacher records from the database.
     *
     * @return array An array of all teacher records.
     */
    public function getAll(): array
    {
        return $this->teacher->all();
    }

    /**
     * Finds a teacher record by its ID.
     *
     * @param int $id The unique identifier of the teacher.
     * @return false|array The teacher data or false if not found.
     * @throws InvalidArgumentException If the ID is not provided.
     */
    public function findById(int $id): false|array
    {
        if (empty($id)) {
            throw new InvalidArgumentException('Id is mandatory.');
        }
        return $this->teacher->find($id);
    }

    /**
     * Updates a teacher record with new data.
     *
     * @param int $id The ID of the teacher to update.
     * @param array $data Associative array of data to update ('dni', 'name').
     * @return Result|false The result of the update operation or false on failure.
     * @throws InvalidArgumentException If the ID is not provided or is not numeric.
     */
    public function update(int $id, array $data): Result|false
    {
        if (empty($id) || !is_numeric($id)) {
            throw new InvalidArgumentException('Id is mandatory and it must be numeric.');
        }
        return $this->teacher->update($id, $data);
    }

    /**
     * Deletes a teacher record from the database.
     *
     * @param int $id The ID of the teacher to delete.
     * @return Result|false The result of the delete operation or false on failure.
     * @throws InvalidArgumentException If the ID is not provided or is not numeric.
     */
    public function delete(int $id): Result|false
    {
        if (empty($id) || !is_numeric($id)) {
            throw new InvalidArgumentException('Id is mandatory and it must be numeric.');
        }
        return $this->teacher->delete($id);
    }
}
