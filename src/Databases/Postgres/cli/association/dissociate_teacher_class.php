<?php

use Service\TeacherClassService;

$teacherClassService = new TeacherClassService($connection);

// Dissociate class with id 1 form teacher with id 2
try {
    $teacherClassService->deleteTeacherFromClass(2, 1);
    echo "Dissociate completed: Teacher with id 2 not associated with class id 1." . PHP_EOL;
} catch (Exception $e) {
    echo "Error to dissociate teacher from class: " . $e->getMessage() . PHP_EOL;
}
