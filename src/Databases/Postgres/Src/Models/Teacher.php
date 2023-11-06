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
        return $this->queryBuilder->select('teachers', '*', "id = {$id}");
    }

    public function all() {
        return $this->queryBuilder->select('teachers');
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