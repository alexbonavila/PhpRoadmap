<?php

namespace Postgres\Src\Models;

use Exception;
use PgSql\Result;
use Postgres\Src\Database\QueryBuilder;

/**
 * The TeacherClass class provides methods for managing the assignments between teachers and classes.
 */
class TeacherClass
{
    /**
     * Instance of QueryBuilder for database operations.
     *
     * @var QueryBuilder
     */
    private QueryBuilder $queryBuilder;

    /**
     * TeacherClass constructor initializes QueryBuilder with a database connection.
     *
     * @param mixed $connection Database connection resource.
     */
    public function __construct(mixed $connection)
    {
        $this->queryBuilder = new QueryBuilder($connection);
    }

    /**
     * Assigns a teacher to a class.
     *
     * @param int $teacherId The ID of the teacher.
     * @param int $classId The ID of the class.
     * @return Result|false The result of the insert operation, or false on failure.
     */
    public function assignTeacherToClass(int $teacherId, int $classId): Result|false
    {
        return $this->queryBuilder->insert('teachers_classes', [
            'teacher_id' => $teacherId,
            'class_id' => $classId
        ]);
    }

    /**
     * Finds all classes assigned to a specific teacher.
     *
     * @param int $teacherId The ID of the teacher.
     * @return array An array of class records associated with the teacher.
     * @throws Exception Throws an exception if the query fails.
     */
    public function findClassesByTeacher(int $teacherId): array
    {
        $query = "SELECT classes.* FROM classes INNER JOIN teachers_classes ON classes.id = teachers_classes.class_id WHERE teachers_classes.teacher_id = $teacherId";

        return $this->queryBuilder->rawQuery($query);
    }

    /**
     * Finds all teachers assigned to a specific class.
     *
     * @param int $classId The ID of the class.
     * @return array An array of teacher records associated with the class.
     * @throws Exception Throws an exception if the query fails.
     */
    public function findTeachersByClass(int $classId): array
    {
        $query = "SELECT teachers.* FROM teachers INNER JOIN teachers_classes ON teachers.id = teachers_classes.teacher_id WHERE teachers_classes.class_id = $classId";

        return $this->queryBuilder->rawQuery($query);
    }

    /**
     * Removes a teacher from a class assignment.
     *
     * @param int $teacherId The ID of the teacher.
     * @param int $classId The ID of the class.
     * @return Result|false The result of the delete operation, or false on failure.
     */
    public function removeTeacherFromClass(int $teacherId, int $classId): Result|false
    {
        return $this->queryBuilder->delete('teachers_classes', [
            'teacher_id' => $teacherId,
            'class_id' => $classId
        ]);
    }
}
