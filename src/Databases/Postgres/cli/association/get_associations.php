<?php

use Service\TeacherClassService;

$teacherClassService = new TeacherClassService($connection);

// Read all classes from teacher with id 1
echo "Classes from teacher with ID 1:" . PHP_EOL;
$classes = $teacherClassService->findClassesByTeacher(1);
foreach ($classes as $class) {
    echo "ID: {$class['id']}, Code: {$class['code']}, Name: {$class['name']}" . PHP_EOL;
}

// Read all teachers form class with id 1
echo  PHP_EOL . "Teachers from class with ID 1:" . PHP_EOL;
$teachers = $teacherClassService->findTeachersByClass(1);
foreach ($teachers as $teacher) {
    echo "ID: {$teacher['id']}, DNI: {$teacher['dni']}, Name: {$teacher['name']}" . PHP_EOL;
}
