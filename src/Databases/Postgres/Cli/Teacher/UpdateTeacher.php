<?php

namespace Postgres\Cli\Teacher;

use Exception;
use Postgres\Src\Services\TeacherService;

/**
 * The UpdateTeacher class provides methods to update teacher records in the database.
 */
class UpdateTeacher
{
    /**
     * Instance of TeacherService to interact with teacher records.
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
     * Updates a teacher record by ID with the given data.
     *
     * @param int $id   The ID of the teacher to update.
     * @param array $data The data to update the teacher record with.
     *
     * @return void
     */
    private function update(int $id, array $data): void
    {
        try {
            // Perform the update operation using the TeacherService.
            $this->teacherService->update($id, $data);
            echo "Teacher updated." . PHP_EOL . PHP_EOL;
        } catch (Exception $e) {
            // Catch any exceptions and output an error message.
            echo "Error updating teacher: " . $e->getMessage() . PHP_EOL . PHP_EOL;
        }
    }

    /**
     * Executes the update operations for the teachers.
     *
     * @return void
     */
    public function run(): void
    {
        // Update Teacher with id 1's DNI.
        $this->update(1, ['dni' => '00000000A']);

        // Update Teacher with id 2's name.
        $this->update(2, ['name' => 'Teacher Zero']);
    }
}
