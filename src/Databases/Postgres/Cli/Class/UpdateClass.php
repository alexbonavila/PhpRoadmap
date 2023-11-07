<?php

namespace Postgres\Cli\Class;

use Exception;
use Postgres\Src\Services\ClassService;

/**
 * Class responsible for handling the update operations for class records.
 */
class UpdateClass
{
    /**
     * The service that interacts with the class data.
     *
     * @var ClassService The class service for performing CRUD operations.
     */
    private ClassService $classService;

    /**
     * Constructs the class with a database connection to initialize the ClassService.
     *
     * @param mixed $connection The database connection object or resource.
     */
    public function __construct(mixed $connection)
    {
        // Initialize the ClassService with the given connection.
        $this->classService = new ClassService($connection);
    }

    /**
     * Handles the updating of a class entity in the database.
     *
     * @param int $id The ID of the class to update.
     * @param array $data An associative array with the class data to update.
     * @return void
     */
    private function update(int $id, array $data): void
    {
        try {
            // Attempt to update the class with the given ID and data.
            $this->classService->update($id, $data);
            // Print a success message to the console.
            echo "Class updated." . PHP_EOL . PHP_EOL;
        } catch (Exception $e) {
            // If an exception occurs, print an error message.
            echo "Error updating Class: " . $e->getMessage() . PHP_EOL . PHP_EOL;
        }
    }

    /**
     * Executes the update operations for multiple class records.
     *
     * @return void
     */
    public function run(): void
    {
        // Update class with id 1 and a new code.
        $this->update(1, ['code' => 'C201']);

        // Update class with id 2 and a new name.
        $this->update(2, ['name' => 'Lecture']);
    }
}
