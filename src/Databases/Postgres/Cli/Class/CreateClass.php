<?php

namespace Postgres\Cli\Class;

use Exception;
use Postgres\Src\Services\ClassService;

class CreateClass
{
    private ClassService $classService;

    private array $classes = [
        ['code' => 'C101', 'name' => 'Mathematics'],
        ['code' => 'C102', 'name' => 'Literature'],
        ['code' => 'C103', 'name' => 'Science']
    ];

    public function __construct($connection)
    {
        $this->classService = new ClassService($connection);
    }

    private function create($classData): void
    {
        try {
            $this->classService->create($classData);
            echo "Class created: {$classData['name']}" . PHP_EOL;
        } catch (Exception $e) {
            echo "Error creating Class: {$e->getMessage()}" . PHP_EOL;
        }
    }

    public function run(): void
    {
        foreach ($this->classes as $classData) {
            $this->create($classData);
        }
        echo PHP_EOL;
    }
}



