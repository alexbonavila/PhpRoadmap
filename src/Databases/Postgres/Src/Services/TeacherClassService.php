<?php

namespace Postgres\Src\Services;

use InvalidArgumentException;
use PgSql\Result;
use Postgres\Src\Models\TeacherClass;

/**
 * TeacherClassService handles the association between teachers and classes.
 */
class TeacherClassService {
    /**
     * Instance of TeacherClass for database interactions.
     *
     * @var TeacherClass
     */
    private TeacherClass $teacherClass;

    /**
     * TeacherClassService constructor initializes with a database connection.
     *
     * @param resource $connection The database connection resource.
     */
    public function __construct($connection) {
        $this->teacherClass = new TeacherClass($connection);
    }

    /**
     * Assigns a teacher to a class.
     *
     * @param int $teacherId The ID of the teacher.
     * @param int $classId The ID of the class.
     * @return Result|false The result of the assignment operation or false on failure.
     * @throws InvalidArgumentException If IDs are not provided or are not numeric.
     */
    public function create($teacherId, $classId): Result|false
    {
        if (empty($teacherId) || !is_numeric($teacherId) || empty($classId) || !is_numeric($classId)) {
            throw new InvalidArgumentException('Teacher and Class IDs are required and must be numeric.');
        }
        return $this->teacherClass->assignTeacherToClass($teacherId, $classId);
    }

    /**
     * Retrieves all teachers associated with a given class.
     *
     * @param int $classId The ID of the class.
     * @return array An array of teacher records associated with the class.
     * @throws InvalidArgumentException If the Class ID is not provided or is not numeric.
     * @throws \Exception If the query execution fails.
     */
    public function findTeachersByClass($classId): array
    {
        if (empty($classId) || !is_numeric($classId)) {
            throw new InvalidArgumentException('The Class ID is required and must be numeric.');
        }
        return $this->teacherClass->findTeachersByClass($classId);
    }

    /**
     * Retrieves all classes associated with a given teacher.
     *
     * @param int $teacherId The ID of the teacher.
     * @return array An array of class records associated with the teacher.
     * @throws InvalidArgumentException If the Teacher ID is not provided or is not numeric.
     * @throws \Exception If the query execution fails.
     */
    public function findClassesByTeacher($teacherId): array
    {
        if (empty($teacherId) || !is_numeric($teacherId)) {
            throw new InvalidArgumentException('The Teacher ID is required and must be numeric.');
        }
        return $this->teacherClass->findClassesByTeacher($teacherId);
    }

    /**
     * Removes the association of a teacher from a class.
     *
     * @param int $teacherId The ID of the teacher.
     * @param int $classId The ID of the class.
     * @return Result|false The result of the removal operation or false on failure.
     * @throws InvalidArgumentException If IDs are not provided or are not numeric.
     */
    public function delete($teacherId, $classId): Result|false
    {
        if (empty($teacherId) || !is_numeric($teacherId) || empty($classId) || !is_numeric($classId)) {
            throw new InvalidArgumentException('Teacher and Class IDs are required and must be numeric.');
        }
        return $this->teacherClass->removeTeacherFromClass($teacherId, $classId);
    }
}
