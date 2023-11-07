<?php

namespace Postgres\Cli\Class;

use Exception;
use Postgres\Src\Services\ClassService;

class DeleteClass
{
    private ClassService $classService;

    public function __construct($connection)
    {
        $this->classService = new ClassService($connection);
    }

    private function delete($id): void
    {
        try {
            $this->classService->delete($id);
            echo "Class deleted." . PHP_EOL;
        } catch (Exception $e) {
            echo "Error deleting Class: " . $e->getMessage() . PHP_EOL;
        }
    }

    public function run(): void
    {
        // Delete Class with id 3
        $this->delete(3);
    }
}



