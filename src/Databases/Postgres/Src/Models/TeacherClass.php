<?php

namespace Postgres\Src\Models;

use Postgres\Src\Database\QueryBuilder;

class TeacherClass
{
    private QueryBuilder $queryBuilder;

    public function __construct($connection)
    {
        $this->queryBuilder = new QueryBuilder($connection);
    }

    public function assignTeacherToClass($teacherId, $classId)
    {
        return $this->queryBuilder->insert('teachers_classes', [
            'teacher_id' => $teacherId,
            'class_id' => $classId
        ]);
    }

    public function findClassesByTeacher($teacherId)
    {
        $query = "SELECT classes.* FROM classes INNER JOIN teachers_classes ON classes.id = teachers_classes.class_id WHERE teachers_classes.teacher_id = {$teacherId}";

        return $this->queryBuilder->rawQuery($query);
    }

    public function findTeachersByClass($classId)
    {
        $query = "SELECT teachers.* FROM teachers INNER JOIN teachers_classes ON teachers.id = teachers_classes.teacher_id WHERE teachers_classes.class_id = {$classId}";

        return $this->queryBuilder->rawQuery($query);
    }

    public function removeTeacherFromClass($teacherId, $classId)
    {
        return $this->queryBuilder->delete('teachers_classes', [
            'teacher_id' => $teacherId,
            'class_id' => $classId
        ]);
    }
}