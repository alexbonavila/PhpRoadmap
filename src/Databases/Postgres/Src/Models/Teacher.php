<?php

namespace Postgres\Src\Models;

use PgSql\Result;
use Postgres\Src\Database\QueryBuilder;

class Teacher
{
    private QueryBuilder $queryBuilder;

    public function __construct($connection) {
        $this->queryBuilder = new QueryBuilder($connection);
    }

    public function find($id): false|array
    {
        $result = $this->queryBuilder->select('teachers', '*', "id = $id");

        return pg_fetch_assoc($result);
    }

    public function all(): array
    {
        $result =  $this->queryBuilder->select('teachers');

        $teachers = [];
        while ($row = pg_fetch_assoc($result)) {
            $teachers[] = $row;
        }

        return $teachers;
    }

    public function create($data): Result|false
    {
        return $this->queryBuilder->insert('teachers', $data);
    }

    public function update($id, $data): Result|false
    {
        return $this->queryBuilder->update('teachers', $data, ['id' => $id]);
    }

    public function delete($id): Result|false
    {
        return $this->queryBuilder->delete('teachers', ['id' => $id]);
    }
}