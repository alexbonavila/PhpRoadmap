<?php

namespace Postgres\Src\Services;

use InvalidArgumentException;
use PgSql\Result;
use Postgres\Src\Models\TeacherClass;

class TeacherClassService {
    private TeacherClass $teacherClass;

    public function __construct($connection) {
        $this->teacherClass = new TeacherClass($connection);
    }

    public function create($teacherId, $classId): Result|false
    {
        if (empty($teacherId) || !is_numeric($teacherId) || empty($classId) || !is_numeric($classId)) {
            throw new InvalidArgumentException('Teacher and Class IDs are required and must be numeric.');
        }
        return $this->teacherClass->assignTeacherToClass($teacherId, $classId);
    }

    public function findTeachersByClass($classId): array
    {
        if (empty($classId) || !is_numeric($classId)) {
            throw new InvalidArgumentException('The Class ID is required and must be numeric.');
        }
        return $this->teacherClass->findTeachersByClass($classId);
    }

    public function findClassesByTeacher($teacherId): array
    {
        if (empty($teacherId) || !is_numeric($teacherId)) {
            throw new InvalidArgumentException('The Teacher ID is required and must be numeric.');
        }
        return $this->teacherClass->findClassesByTeacher($teacherId);
    }

    public function delete($teacherId, $classId): Result|false
    {
        if (empty($teacherId) || !is_numeric($teacherId) || empty($classId) || !is_numeric($classId)) {
            throw new InvalidArgumentException('Teacher and Class IDs are required and must be numeric.');
        }
        return $this->teacherClass->removeTeacherFromClass($teacherId, $classId);
    }
}
