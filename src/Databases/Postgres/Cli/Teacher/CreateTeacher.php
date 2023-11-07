<?php

namespace Postgres\Cli\Teacher;

use Exception;
use Postgres\Src\Services\TeacherService;

/**
 * Class responsible for handling the creation of new teacher records.
 */
class CreateTeacher
{
    /**
     * The service that interacts with teacher data.
     *
     * @var TeacherService The teacher service for performing CRUD operations.
     */
    private TeacherService $teacherService;

    /**
     * A predefined list of teachers to be added to the database.
     *
     * @var array An array of arrays, each containing teacher data like DNI and name.
     */
    private array $teachers = [
        ['dni' => '12345678A', 'name' => 'Teacher One'],
        ['dni' => '23456789B', 'name' => 'Teacher Two'],
        ['dni' => '23456789C', 'name' => 'Teacher Three'],
        ['dni' => '23456789D', 'name' => 'Teacher Four'],
        ['dni' => '23456789E', 'name' => 'Teacher Five'],
        ['dni' => '23456789F', 'name' => 'Teacher Six'],
    ];

    /**
     * Constructs the class with a database connection to initialize the TeacherService.
     *
     * @param mixed $connection The database connection object or resource.
     */
    public function __construct(mixed $connection)
    {
        // Initialize the TeacherService with the given connection.
        $this->teacherService = new TeacherService($connection);
    }

    /**
     * Handles the creation of a teacher entity in the database.
     *
     * @param array $teacherData An associative array with the teacher data to be created.
     * @return void
     */
    private function create(array $teacherData): void
    {
        try {
            // Attempt to create the teacher with the given data.
            $this->teacherService->create($teacherData);
            // Print a success message to the console.
            echo "Teacher created: {$teacherData['name']}" . PHP_EOL;
        } catch (Exception $e) {
            // If an exception occurs, print an error message.
            echo "Error creating Teacher: {$e->getMessage()}" . PHP_EOL;
        }
    }

    /**
     * Executes the creation of teacher records based on the predefined list.
     *
     * @return void
     */
    public function run(): void
    {
        // Loop through the list of teachers and create each one.
        foreach ($this->teachers as $teacherData) {
            $this->create($teacherData);
        }
        // Optionally print a newline for better readability in the console output.
        echo PHP_EOL;
    }
}
