<?php

use Service\TeacherService;

$teacherService = new TeacherService($connection);

// Update teacher with id 1
try {
    $teacherService->update(1, ['dni' => '00000000A']);
    echo "Profesor 1 actualizado con nuevo DNI 00000000A." . PHP_EOL;
} catch (Exception $e) {
    echo "Error al actualizar el profesor: " . $e->getMessage() . PHP_EOL;
}

// Update teacher with id 2
try {
    $teacherService->update(2, ['name' => 'Teacher Zero']);
    echo "Profesor 2 actualizado con nuevo nombre Profesor Zero." . PHP_EOL;
} catch (Exception $e) {
    echo "Error al actualizar el profesor: " . $e->getMessage() . PHP_EOL;
}
