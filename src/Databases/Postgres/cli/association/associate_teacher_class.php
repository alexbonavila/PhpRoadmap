<?php

use Service\TeacherClassService;

$teacherClassService = new TeacherClassService($connection);

$associations = [
    ['code' => 1, 'dni' => [1, 2, 3]],
    ['code' => 2, 'dni' => [2, 6]],
    ['code' => 3, 'dni' => [3, 4]]
];

foreach ($associations as $association) {
    foreach ($association['dni'] as $teacherId) {
        try {
            $teacherClassService->create($teacherId, $association['code']);
            echo "Teacher {$teacherId} associated with class {$association['code']}" . PHP_EOL;
        } catch (Exception $e) {
            echo "Error when associating teacher with class: {$e->getMessage()}" . PHP_EOL;
        }
    }
}
