<?php

namespace Postgres\Cli\Association;

use Exception;
use Postgres\Src\Services\TeacherClassService;

/**
 * Class responsible for associating teachers with classes.
 */
class AssociateTeacherClass
{
    /**
     * The service handling teacher-class association logic.
     *
     * @var TeacherClassService
     */
    private TeacherClassService $teacherClassService;

    /**
     * Default associations between class codes and teacher DNIs.
     *
     * @var array|array[] An array of arrays containing class codes and teacher DNI arrays.
     */
    private array $associations = [
        ['code' => 1, 'dni' => [1, 2, 3]],
        ['code' => 2, 'dni' => [2, 6]],
        ['code' => 3, 'dni' => [3, 4]]
    ];

    /**
     * Construct the AssociateTeacherClass service with a database connection.
     *
     * @param mixed $connection A database connection resource.
     */
    public function __construct($connection)
    {
        $this->teacherClassService = new TeacherClassService($connection);
    }

    /**
     * Handles the association of a single teacher with a class.
     *
     * @param int $teacherId The ID of the teacher to associate.
     * @param array $association An array containing the 'code' of the class.
     * @return void
     */
    private function associate(int $teacherId, array $association): void
    {
        try {
            $this->teacherClassService->create($teacherId, $association['code']);
            echo "Teacher $teacherId associated with Class {$association['code']}" . PHP_EOL;
        } catch (Exception $e) {
            echo "Error when associating Teacher with Class: {$e->getMessage()}" . PHP_EOL;
        }
    }

    /**
     * Runs the process of associating teachers with classes based on predefined associations.
     *
     * @return void
     */
    public function run(): void
    {
        foreach ($this->associations as $association) {
            foreach ($association['dni'] as $teacherId) {
                $this->associate($teacherId, $association);
            }
        }
        echo PHP_EOL;
    }
}
