<?php

namespace Postgres\Src\Services;

use InvalidArgumentException;
use PgSql\Result;
use Postgres\Src\Models\ClassModel;

/**
 * ClassService is responsible for handling the business logic related to classes.
 */
class ClassService {
    /**
     * Instance of ClassModel for interacting with the database.
     *
     * @var ClassModel
     */
    private ClassModel $classModel;

    /**
     * ClassService constructor initializes the class model with a database connection.
     *
     * @param resource $connection Database connection resource.
     */
    public function __construct($connection) {
        $this->classModel = new ClassModel($connection);
    }

    /**
     * Creates a new class with the provided data.
     *
     * @param array $data Class data to be inserted into the database.
     * @return Result|false The result of the insert operation or false on failure.
     * @throws InvalidArgumentException If required fields are missing.
     */
    public function create(array $data): Result|false
    {
        if (empty($data['code']) || empty($data['name'])) {
            throw new InvalidArgumentException('The code and name are required.');
        }
        return $this->classModel->create($data);
    }

    /**
     * Retrieves all classes from the database.
     *
     * @return array An array of all class records.
     */
    public function getAll(): array
    {
        return $this->classModel->all();
    }

    /**
     * Finds a class by its ID.
     *
     * @param int $id The ID of the class to find.
     * @return false|array The class information or false if not found.
     * @throws InvalidArgumentException If the ID is not provided.
     */
    public function findById(int $id): false|array
    {
        if (empty($id)) {
            throw new InvalidArgumentException('The ID is mandatory.');
        }
        return $this->classModel->find($id);
    }

    /**
     * Updates a class with the given ID and data.
     *
     * @param int $id The ID of the class to update.
     * @param array $data The new data for the class.
     * @return Result|false The result of the update operation or false on failure.
     * @throws InvalidArgumentException If the ID is invalid or missing.
     */
    public function update(int $id, array $data): Result|false
    {
        if (empty($id) || !is_numeric($id)) {
            throw new InvalidArgumentException('The ID is required and must be numeric.');
        }
        return $this->classModel->update($id, $data);
    }

    /**
     * Deletes a class with the specified ID.
     *
     * @param int $id The ID of the class to delete.
     * @return Result|false The result of the delete operation or false on failure.
     * @throws InvalidArgumentException If the ID is invalid or missing.
     */
    public function delete(int $id): Result|false
    {
        if (empty($id) || !is_numeric($id)) {
            throw new InvalidArgumentException('The ID is required and must be numeric.');
        }
        return $this->classModel->delete($id);
    }
}
