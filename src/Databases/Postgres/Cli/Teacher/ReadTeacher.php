<?php

namespace Postgres\Cli\Teacher;

use Postgres\Src\Services\TeacherService;

/**
 * The ReadTeacher class provides functionality to read teacher records from the database.
 */
class ReadTeacher
{
    /**
     * TeacherService instance to interact with the teacher data.
     *
     * @var TeacherService
     */
    private TeacherService $teacherService;

    /**
     * Constructs the class with a database connection to initialize the TeacherService.
     *
     * @param mixed $connection The database connection object or resource.
     */
    public function __construct(mixed $connection)
    {
        // Initialize the TeacherService with the provided connection.
        $this->teacherService = new TeacherService($connection);
    }

    /**
     * Reads and prints all teacher records to the output.
     *
     * @return void
     */
    private function readAll(): void
    {
        echo "All teachers:" . PHP_EOL;
        // Retrieve all teacher records.
        $teachers = $this->teacherService->getAll();
        // Iterate through each teacher and print their details.
        foreach ($teachers as $teacher) {
            echo "ID: {$teacher['id']}, DNI: {$teacher['dni']}, Name: {$teacher['name']}" . PHP_EOL;
        }
    }

    /**
     * Reads and prints the details of a teacher by their ID.
     *
     * @param int $id The ID of the teacher to find.
     * @return void
     */
    private function readById(int $id): void
    {
        echo PHP_EOL . "Teacher:" . PHP_EOL;
        // Find the teacher by the provided ID.
        $teacher = $this->teacherService->findById($id);
        // If the teacher is found, print their details.
        if ($teacher) {
            echo "ID: {$teacher['id']}, DNI: {$teacher['dni']}, Name: {$teacher['name']}" . PHP_EOL;
        } else {
            // If no teacher is found, print a not found message.
            echo "Teacher not found." . PHP_EOL;
        }
    }

    /**
     * Runs the process to read and display teacher records.
     *
     * @return void
     */
    public function run(): void
    {
        // Execute the method to read and print all teachers.
        $this->readAll();
        // Execute the method to read and print a single teacher by ID.
        $this->readById(1);
    }
}
