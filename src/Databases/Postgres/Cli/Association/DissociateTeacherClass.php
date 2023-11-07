<?php

namespace Postgres\Cli\Association;

use Exception;
use Postgres\Src\Services\TeacherClassService;

class DissociateTeacherClass
{
    private TeacherClassService $teacherClassService;

    public function __construct($connection)
    {
        $this->teacherClassService = new TeacherClassService($connection);
    }

    private function dissociate($teacherId, $classId): void
    {
        try {
            $this->teacherClassService->delete($teacherId, $classId);
            echo "Dissociate completed: Teacher with id 2 not associated with Class id 1." . PHP_EOL . PHP_EOL;
        } catch (Exception $e) {
            echo "Error to dissociate Teacher from Class: " . $e->getMessage() . PHP_EOL . PHP_EOL;
        }
    }

    public function run(): void
    {
        // Dissociate Class with id 1 form Teacher with id 2
        $this->dissociate(2, 1);
    }
}


