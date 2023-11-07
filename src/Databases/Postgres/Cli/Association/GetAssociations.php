<?php

namespace Postgres\Cli\Association;

use Postgres\Src\Services\TeacherClassService;

/**
 * Class responsible for retrieving associations between teachers and classes.
 */
class GetAssociations
{
    /**
     * The service handling data retrieval for teacher-class associations.
     *
     * @var TeacherClassService
     */
    private TeacherClassService $teacherClassService;

    /**
     * Initializes the service with a database connection.
     *
     * @param mixed $connection A database connection resource or object.
     */
    public function __construct(mixed $connection)
    {
        // Initializes the TeacherClassService with the provided connection.
        $this->teacherClassService = new TeacherClassService($connection);
    }

    /**
     * Retrieves and outputs a list of classes associated with a specific teacher.
     *
     * @return void
     */
    private function findClassesByTeacher(): void
    {
        // Output header
        echo PHP_EOL . "Classes from Teacher with ID 1:" . PHP_EOL;
        // Retrieve classes associated with Teacher ID 1
        $classes = $this->teacherClassService->findClassesByTeacher(1);
        // Iterate through the classes and output their details
        foreach ($classes as $class) {
            echo "ID: {$class['id']}, Code: {$class['code']}, Name: {$class['name']}" . PHP_EOL;
        }
    }

    /**
     * Retrieves and outputs a list of teachers associated with a specific class.
     *
     * @return void
     */
    private function findTeachersByClass(): void
    {
        // Output header
        echo  PHP_EOL . "Teachers from Class with ID 1:" . PHP_EOL;
        // Retrieve teachers associated with Class ID 1
        $teachers = $this->teacherClassService->findTeachersByClass(1);
        // Iterate through the teachers and output their details
        foreach ($teachers as $teacher) {
            echo "ID: {$teacher['id']}, DNI: {$teacher['dni']}, Name: {$teacher['name']}" . PHP_EOL;
        }
        echo PHP_EOL;
    }

    /**
     * Runs the process of retrieving and displaying associations.
     *
     * @return void
     */
    public function run(): void
    {
        // Find and output classes associated with a teacher
        $this->findClassesByTeacher();
        // Find and output teachers associated with a class
        $this->findTeachersByClass();
    }
}
