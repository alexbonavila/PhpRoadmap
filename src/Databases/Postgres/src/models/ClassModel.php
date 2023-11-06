<?php

class ClassModel
{
    private QueryBuilder $queryBuilder;

    public function __construct($connection) {
        $this->queryBuilder = new QueryBuilder($connection);
    }

    public function find($id) {
        return $this->queryBuilder->select('classes', '*', "id = {$id}");
    }

    public function all() {
        return $this->queryBuilder->select('classes');
    }

    public function create($data) {
        return $this->queryBuilder->insert('classes', $data);
    }

    public function update($id, $data) {
        return $this->queryBuilder->update('classes', $data, ['id' => $id]);
    }

    public function delete($id) {
        return $this->queryBuilder->delete('classes', ['id' => $id]);
    }
}