<?php

use Service\TeacherService;

$teacherService = new TeacherService($connection);

// Read all teachers
echo "All teachers:" . PHP_EOL;
$teachers = $teacherService->getAll();
foreach ($teachers as $teacher) {
    echo "ID: {$teacher['id']}, DNI: {$teacher['dni']}, Name: {$teacher['name']}" . PHP_EOL;
}

// Read teacher with id 1
echo  PHP_EOL . " Teacher with ID 1:" . PHP_EOL;
$teacher = $teacherService->findById(1);
if ($teacher) {
    echo "ID: {$teacher['id']}, DNI: {$teacher['dni']}, Name: {$teacher['name']}" . PHP_EOL;
} else {
    echo "Teacher with ID 1 not found." . PHP_EOL;
}
