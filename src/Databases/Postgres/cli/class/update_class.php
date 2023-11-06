<?php

use Service\ClassService;

$classService = new ClassService($connection);

// Update class with id 1
try {
    $classService->update(1, ['code' => 'C201']);
    echo "Class 1 updated with new code C201." . PHP_EOL;
} catch (Exception $e) {
    echo "Error updating class: " . $e->getMessage() . PHP_EOL;
}

// Update class with id 2
try {
    $classService->update(2, ['name' => 'Lecture']);
    echo "Class 2 updated with new name Lecture." . PHP_EOL;
} catch (Exception $e) {
    echo "Error updating class: " . $e->getMessage() . PHP_EOL;
}
