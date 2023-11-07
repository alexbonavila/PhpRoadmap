<?php

namespace Postgres\Cli\Teacher;

use Exception;
use Postgres\Src\Services\TeacherService;


class CreateTeacher
{
    private TeacherService $teacherService;

    private array $teachers = [
        ['dni' => '12345678A', 'name' => 'Teacher One'],
        ['dni' => '23456789B', 'name' => 'Teacher Two'],
        ['dni' => '23456789C', 'name' => 'Teacher Three'],
        ['dni' => '23456789D', 'name' => 'Teacher Four'],
        ['dni' => '23456789E', 'name' => 'Teacher Five'],
        ['dni' => '23456789F', 'name' => 'Teacher Six'],
    ];

    public function __construct($connection)
    {
        $this->teacherService = new TeacherService($connection);
    }

    private function create($teacherData): void
    {
        try {
            $this->teacherService->create($teacherData);
            echo "Teacher created: {$teacherData['name']}" . PHP_EOL;
        } catch (Exception $e) {
            echo "Error creating Teacher: {$e->getMessage()}" . PHP_EOL;
        }
    }

    public function run(): void
    {
        foreach ($this->teachers as $teacherData) {
            $this->create($teacherData);
        }
        echo PHP_EOL;
    }
}


