<?php

namespace Postgres\Cli\Association;

use Postgres\Src\Services\TeacherClassService;

class GetAssociations
{
    private TeacherClassService $teacherClassService;

    public function __construct($connection)
    {
        $this->teacherClassService = new TeacherClassService($connection);
    }

    private function findClassesByTeacher(): void
    {
        // Read all classes from Teacher with id 1
        echo PHP_EOL . "Classes from Teacher with ID 1:" . PHP_EOL;
        $classes = $this->teacherClassService->findClassesByTeacher(1);
        foreach ($classes as $class) {
            echo "ID: {$class['id']}, Code: {$class['code']}, Name: {$class['name']}" . PHP_EOL;
        }

    }

    private function findTeachersByClass(): void
    {
        // Read all teachers form Class with id 1
        echo  PHP_EOL . "Teachers from Class with ID 1:" . PHP_EOL;
        $teachers = $this->teacherClassService->findTeachersByClass(1);
        foreach ($teachers as $teacher) {
            echo "ID: {$teacher['id']}, DNI: {$teacher['dni']}, Name: {$teacher['name']}" . PHP_EOL;
        }
        echo PHP_EOL;
    }

    public function run(): void
    {
        $this->findClassesByTeacher();

        $this->findTeachersByClass();
    }

}



