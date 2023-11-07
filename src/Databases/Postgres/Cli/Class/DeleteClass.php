<?php

namespace Postgres\Cli\Class;

use Exception;
use Postgres\Src\Services\ClassService;

/**
 * Class responsible for handling the deletion of class records.
 */
class DeleteClass
{
    /**
     * Service for class-related operations, particularly deletion.
     *
     * @var ClassService
     */
    private ClassService $classService;

    /**
     * Constructor to initialize the class service with a database connection.
     *
     * @param mixed $connection Database connection resource or object.
     */
    public function __construct(mixed $connection)
    {
        // Initializes the ClassService with the given connection.
        $this->classService = new ClassService($connection);
    }

    /**
     * Deletes a class record by its identifier.
     *
     * @param int $id The unique identifier of the class to be deleted.
     * @return void
     */
    private function delete(int $id): void
    {
        try {
            // Attempt to delete the class record with the given ID.
            $this->classService->delete($id);
            // Output success message upon deletion.
            echo "Class deleted." . PHP_EOL;
        } catch (Exception $e) {
            // Output error message if the deletion fails.
            echo "Error deleting Class: " . $e->getMessage() . PHP_EOL;
        }
    }

    /**
     * Triggers the deletion process for a class record.
     *
     * @return void
     */
    public function run(): void
    {
        // Initiates the deletion of the class with a specific ID.
        $this->delete(3);
    }
}
