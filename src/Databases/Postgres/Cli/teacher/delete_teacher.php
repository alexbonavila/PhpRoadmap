<?php

use Service\TeacherService;

$teacherService = new TeacherService($connection);

// Delete teacher with id 5
try {
    $teacherService->delete(5);
    echo "Teacher with id 5 deleted." . PHP_EOL;
} catch (Exception $e) {
    echo "Error deleting el teacher: " . $e->getMessage() . PHP_EOL;
}
