<?php

namespace Postgres\Cli\Class;

use Exception;
use Postgres\Src\Services\ClassService;

class UpdateClass
{
    private ClassService $classService;

    public function __construct($connection)
    {
        $this->classService = new ClassService($connection);
    }

    private function update($id, $data): void
    {
        try {
            $this->classService->update($id, $data);
            echo "Class updated." . PHP_EOL . PHP_EOL;
        } catch (Exception $e) {
            echo "Error updating Class: " . $e->getMessage() . PHP_EOL . PHP_EOL;
        }
    }

    public function run(): void
    {
        // Update Class with id 1
        $this->update(1, ['code' => 'C201']);

        // Update Class with id 2
        $this->update(2, ['name' => 'Lecture']);
    }
}