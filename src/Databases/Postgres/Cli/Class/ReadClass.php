<?php

namespace Postgres\Cli\Class;

use Postgres\Src\Services\ClassService;

class ReadClass
{
    private ClassService $classService;

    public function __construct($connection)
    {
        $this->classService = new ClassService($connection);
    }

    private function readAll(): void
    {
        echo "All the classes:" . PHP_EOL;
        $classes = $this->classService->getAll();
        foreach ($classes as $class) {
            echo "ID: {$class['id']}, Code: {$class['code']}, Name: {$class['name']}" . PHP_EOL;
        }
    }

    private function readById($id): void
    {
        echo PHP_EOL."Class:" . PHP_EOL;
        $class = $this->classService->findById($id);
        if ($class) {
            echo "ID: {$class['id']}, Code: {$class['code']}, Name: {$class['name']}" . PHP_EOL . PHP_EOL;
        } else {
            echo "Class not found." . PHP_EOL . PHP_EOL;
        }
    }

    public function run(): void
    {
        // Read all classes
        $this->readAll();

        // Read the Class with id 1
        $this->readById(1);
    }
}
