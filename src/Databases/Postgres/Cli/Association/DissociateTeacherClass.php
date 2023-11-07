<?php

namespace Postgres\Cli\Association;

use Exception;
use Postgres\Src\Services\TeacherClassService;

/**
 * Class responsible for dissociating teachers from classes.
 */
class DissociateTeacherClass
{
    /**
     * Service handling the logic for teacher-class dissociation.
     *
     * @var TeacherClassService
     */
    private TeacherClassService $teacherClassService;

    /**
     * Constructor for the dissociation class.
     *
     * @param mixed $connection Database connection resource or object.
     */
    public function __construct(mixed $connection)
    {
        // Initializes the TeacherClassService with the given connection.
        $this->teacherClassService = new TeacherClassService($connection);
    }

    /**
     * Handles the dissociation of a teacher from a class.
     *
     * @param int $teacherId The unique identifier of the teacher.
     * @param int $classId The unique identifier of the class.
     * @return void
     */
    private function dissociate(int $teacherId, int $classId): void
    {
        try {
            // Attempt to delete the association in the TeacherClassService.
            $this->teacherClassService->delete($teacherId, $classId);
            // Output success message.
            echo "Dissociate completed: Teacher with id $teacherId not associated with Class id $classId." . PHP_EOL . PHP_EOL;
        } catch (Exception $e) {
            // Output error message in case of an exception.
            echo "Error to dissociate Teacher from Class: " . $e->getMessage() . PHP_EOL . PHP_EOL;
        }
    }

    /**
     * Executes the dissociation process for predefined teacher and class IDs.
     *
     * @return void
     */
    public function run(): void
    {
        // Perform dissociation for Teacher with id 2 from Class with id 1
        $this->dissociate(2, 1);
    }
}
