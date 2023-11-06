<?php

namespace Postgres\Cli\Association;


use Exception;
use Postgres\Src\Services\TeacherClassService;

class AssociateTeacherClass
{
    private TeacherClassService $teacherClassService;

    public function __construct($connection)
    {
        $this->teacherClassService = new TeacherClassService($connection);
    }

    public function run()
    {
        $associations = [
            ['code' => 1, 'dni' => [1, 2, 3]],
            ['code' => 2, 'dni' => [2, 6]],
            ['code' => 3, 'dni' => [3, 4]]
        ];

        foreach ($associations as $association) {
            foreach ($association['dni'] as $teacherId) {
                try {
                    $this->teacherClassService->create($teacherId, $association['code']);
                    echo "Teacher {$teacherId} associated with Class {$association['code']}" . PHP_EOL;
                } catch (Exception $e) {
                    echo "Error when associating Teacher with Class: {$e->getMessage()}" . PHP_EOL;
                }
            }
        }

    }
}

