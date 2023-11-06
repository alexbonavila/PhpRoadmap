<?php

use Service\ClassService;

$classService = new ClassService($connection);

// Read all classes
echo "All las classes:" . PHP_EOL;
$classes = $classService->getAll();
foreach ($classes as $class) {
    echo "ID: {$class['id']}, Code: {$class['code']}, Name: {$class['name']}" . PHP_EOL;
}

// Read the class with id 1
echo PHP_EOL."Classe with ID 1:" . PHP_EOL;
$class = $classService->findById(1);
if ($class) {
    echo "ID: {$class['id']}, Code: {$class['code']}, Name: {$class['name']}" . PHP_EOL;
} else {
    echo "Class with ID 1 not found." . PHP_EOL;
}
