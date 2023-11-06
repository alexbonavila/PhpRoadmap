<?php

namespace Postgres\Src\Models;

use Postgres\Src\Database\QueryBuilder;

class Teacher
{
    private QueryBuilder $queryBuilder;

    public function __construct($connection) {
        $this->queryBuilder = new QueryBuilder($connection);
    }

    public function find($id) {
        $result = $this->queryBuilder->select('teachers', '*', "id = {$id}");

        return pg_fetch_assoc($result);
    }

    public function all() {
        $result =  $this->queryBuilder->select('teachers');

        $teachers = [];
        while ($row = pg_fetch_assoc($result)) {
            $teachers[] = $row;
        }

        return $teachers;
    }

    public function create($data) {
        return $this->queryBuilder->insert('teachers', $data);
    }

    public function update($id, $data) {
        return $this->queryBuilder->update('teachers', $data, ['id' => $id]);
    }

    public function delete($id) {
        return $this->queryBuilder->delete('teachers', ['id' => $id]);
    }
}