<?php

namespace Postgres\Cli\Teacher;

use Exception;
use Postgres\Src\Services\TeacherService;


class UpdateTeacher
{
    private TeacherService $teacherService;

    public function __construct($connection)
    {
        $this->teacherService = new TeacherService($connection);
    }

    private function update($id, $data)
    {
        try {
            $this->teacherService->update($id, $data);
            echo "Teacher updated." . PHP_EOL;
        } catch (Exception $e) {
            echo "Error updating teacher: " . $e->getMessage() . PHP_EOL;
        }
    }

    public function run()
    {
        // Update Teacher with id 1
        $this->update(1, ['dni' => '00000000A']);

        // Update Teacher with id 2
        $this->update(2, ['name' => 'Teacher Zero']);
    }
}


