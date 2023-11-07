<?php

namespace Postgres\Cli\Teacher;

use Exception;
use Postgres\Src\Services\TeacherService;

/**
 * Class responsible for handling the deletion of teacher records.
 */
class DeleteTeacher
{
    /**
     * The service that interacts with teacher data.
     *
     * @var TeacherService The teacher service for performing CRUD operations.
     */
    private TeacherService $teacherService;

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
     * Handles the deletion of a teacher entity from the database by ID.
     *
     * @param int $id The unique identifier of the teacher to be deleted.
     * @return void
     */
    private function delete(int $id): void
    {
        try {
            // Attempt to delete the teacher with the specified ID.
            $this->teacherService->delete($id);
            // Print a success message to the console with the ID of the deleted teacher.
            echo "Teacher with id $id deleted." . PHP_EOL;
        } catch (Exception $e) {
            // If an exception occurs, print an error message with the exception details.
            echo "Error deleting the Teacher: " . $e->getMessage() . PHP_EOL;
        }
    }

    /**
     * Executes the deletion of a teacher record by ID.
     *
     * @return void
     */
    public function run(): void
    {
        // Specify the ID of the teacher to be deleted.
        $teacherId = 5;
        // Delete the teacher with the specified ID.
        $this->delete($teacherId);
    }
}
