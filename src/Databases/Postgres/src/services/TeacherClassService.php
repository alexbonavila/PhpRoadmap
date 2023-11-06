<?php

class TeacherClassService {
    private TeacherClass $teacherClass;

    public function __construct($connection) {
        $this->teacherClass = new TeacherClass($connection);
    }

    public function create($teacherId, $classId) {
        if (empty($teacherId) || !is_numeric($teacherId) || empty($classId) || !is_numeric($classId)) {
            throw new InvalidArgumentException('Teacher and class IDs are required and must be numeric.');
        }
        return $this->teacherClass->assignTeacherToClass($teacherId, $classId);
    }

    public function findTeachersByClass($classId) {
        if (empty($classId) || !is_numeric($classId)) {
            throw new InvalidArgumentException('The class ID is required and must be numeric.');
        }
        return $this->teacherClass->findTeachersByClass($classId);
    }

    public function findClassesByTeacher($teacherId) {
        if (empty($teacherId) || !is_numeric($teacherId)) {
            throw new InvalidArgumentException('The teacher ID is required and must be numeric.');
        }
        return $this->teacherClass->findClassesByTeacher($teacherId);
    }

    public function delete($teacherId, $classId) {
        if (empty($teacherId) || !is_numeric($teacherId) || empty($classId) || !is_numeric($classId)) {
            throw new InvalidArgumentException('Teacher and class IDs are required and must be numeric.');
        }
        return $this->teacherClass->removeTeacherFromClass($teacherId, $classId);
    }
}
