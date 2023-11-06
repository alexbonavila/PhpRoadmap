<?php

namespace Postgres\Cli\Teacher;

use Postgres\Src\Services\TeacherService;


class ReadTeacher
{
    private TeacherService $teacherService;

    public function __construct($connection)
    {
        $this->teacherService = new TeacherService($connection);
    }

    private function readAll()
    {
        echo "All teachers:" . PHP_EOL;
        $teachers = $this->teacherService->getAll();
        foreach ($teachers as $teacher) {
            echo "ID: {$teacher['id']}, DNI: {$teacher['dni']}, Name: {$teacher['name']}" . PHP_EOL;
        }
    }

    private function readById($id)
    {
        echo  PHP_EOL . " Teacher:" . PHP_EOL;
        $teacher = $this->teacherService->findById($id);
        if ($teacher) {
            echo "ID: {$teacher['id']}, DNI: {$teacher['dni']}, Name: {$teacher['name']}" . PHP_EOL;
        } else {
            echo "Teacher not found." . PHP_EOL;
        }

    }

    public function run()
    {
        // Read all teachers
        $this->readAll();

        // Read Teacher with id 1
        $this->readById(1);
    }
}





