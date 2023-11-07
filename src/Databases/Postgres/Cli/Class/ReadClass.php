<?php

namespace Postgres\Cli\Class;

use Postgres\Src\Services\ClassService;

/**
 * Class responsible for reading class records from the database.
 */
class ReadClass
{
    /**
     * Service for class-related read operations.
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
     * Reads and displays all class records from the database.
     *
     * @return void
     */
    private function readAll(): void
    {
        // Output a header for the list of classes.
        echo "All the classes:" . PHP_EOL;
        // Retrieve all class records.
        $classes = $this->classService->getAll();
        // Iterate through each class and print its details.
        foreach ($classes as $class) {
            echo "ID: {$class['id']}, Code: {$class['code']}, Name: {$class['name']}" . PHP_EOL;
        }
    }

    /**
     * Reads and displays a class record by its ID.
     *
     * @param int $id The unique identifier of the class to be retrieved.
     * @return void
     */
    private function readById(int $id): void
    {
        // Output a header for the single class.
        echo PHP_EOL . "Class:" . PHP_EOL;
        // Retrieve the class record by ID.
        $class = $this->classService->findById($id);
        // Check if the class was found and print its details or a not found message.
        if ($class) {
            echo "ID: {$class['id']}, Code: {$class['code']}, Name: {$class['name']}" . PHP_EOL . PHP_EOL;
        } else {
            echo "Class not found." . PHP_EOL . PHP_EOL;
        }
    }

    /**
     * Orchestrates the reading of class records by calling the appropriate methods.
     *
     * @return void
     */
    public function run(): void
    {
        // Read and display all classes.
        $this->readAll();

        // Read and display the class with a specific ID.
        $this->readById(1);
    }
}
