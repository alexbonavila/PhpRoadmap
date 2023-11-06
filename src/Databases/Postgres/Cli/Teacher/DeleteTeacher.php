<?php

namespace Postgres\Cli\Teacher;

use Exception;
use Postgres\Src\Services\TeacherService;

class DeleteTeacher
{
    private TeacherService $teacherService;

    public function __construct($connection)
    {
        $this->teacherService = new TeacherService($connection);
    }

    private function delete($id)
    {
        try {
            $this->teacherService->delete($id);
            echo "Teacher with id 5 deleted." . PHP_EOL;
        } catch (Exception $e) {
            echo "Error deleting el Teacher: " . $e->getMessage() . PHP_EOL;
        }
    }

    public function run()
    {
        // Delete Teacher with id 5
        $this->delete(5);
    }
}



