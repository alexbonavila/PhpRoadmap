<?php

use Service\ClassService;

$classService = new ClassService($connection);

$classes = [
    ['code' => 'C101', 'name' => 'Mathematics'],
    ['code' => 'C102', 'name' => 'Literature'],
    ['code' => 'C103', 'name' => 'Science']
];

foreach ($classes as $classData) {
    try {
        $classService->create($classData);
        echo "Class created: {$classData['name']}" . PHP_EOL;
    } catch (Exception $e) {
        echo "Error creating class: {$e->getMessage()}" . PHP_EOL;
    }
}
