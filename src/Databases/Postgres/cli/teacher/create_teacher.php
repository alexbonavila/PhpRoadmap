<?php

use Service\TeacherService;

$teacherService = new TeacherService($connection);

$teachers = [
    ['dni' => '12345678A', 'name' => 'Teacher One'],
    ['dni' => '23456789B', 'name' => 'Teacher Two'],
    ['dni' => '23456789C', 'name' => 'Teacher Three'],
    ['dni' => '23456789D', 'name' => 'Teacher Four'],
    ['dni' => '23456789E', 'name' => 'Teacher Five'],
    ['dni' => '23456789F', 'name' => 'Teacher Six'],
];

foreach ($teachers as $teacherData) {
    try {
        $teacherService->create($teacherData);
        echo "Teacher created: {$teacherData['name']}" . PHP_EOL;
    } catch (Exception $e) {
        echo "Error creating teacher: {$e->getMessage()}" . PHP_EOL;
    }
}
