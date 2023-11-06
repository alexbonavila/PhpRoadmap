<?php

use Service\ClassService;

$classService = new ClassService($connection);

// Delete class with id 3
try {
    $classService->delete(3);
    echo "Class with id 3 deleted." . PHP_EOL;
} catch (Exception $e) {
    echo "Error deleting class: " . $e->getMessage() . PHP_EOL;
}
