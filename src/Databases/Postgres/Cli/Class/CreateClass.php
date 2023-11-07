<?php

namespace Postgres\Cli\Class;

use Exception;
use Postgres\Src\Services\ClassService;

/**
 * Class responsible for creating multiple class records.
 */
class CreateClass
{
    /**
     * Service for class-related operations.
     *
     * @var ClassService
     */
    private ClassService $classService;

    /**
     * Default set of class data to be created.
     *
     * @var array An array of arrays, each containing 'code' and 'name' for a class.
     */
    private array $classes = [
        ['code' => 'C101', 'name' => 'Mathematics'],
        ['code' => 'C102', 'name' => 'Literature'],
        ['code' => 'C103', 'name' => 'Science']
    ];

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
     * Creates a class record using class data.
     *
     * @param array $classData An associative array with 'code' and 'name' keys.
     * @return void
     */
    private function create(array $classData): void
    {
        try {
            // Attempt to create a new class record with the provided data.
            $this->classService->create($classData);
            // Output success message on creation.
            echo "Class created: {$classData['name']}" . PHP_EOL;
        } catch (Exception $e) {
            // Output error message if the creation fails.
            echo "Error creating Class: {$e->getMessage()}" . PHP_EOL;
        }
    }

    /**
     * Runs the creation process for all predefined class data.
     *
     * @return void
     */
    public function run(): void
    {
        // Iterate through each class data and create the class.
        foreach ($this->classes as $classData) {
            $this->create($classData);
        }
        // Extra newline for clean separation in output.
        echo PHP_EOL;
    }
}
