<?php

namespace Postgres\Src\Models;

use PgSql\Result;
use Postgres\Src\Database\QueryBuilder;

class ClassModel
{
    private QueryBuilder $queryBuilder;

    public function __construct($connection) {
        $this->queryBuilder = new QueryBuilder($connection);
    }

    public function find($id): false|array
    {
        $result = $this->queryBuilder->select('classes', '*', "id = $id");

        return pg_fetch_assoc($result);
    }

    public function all(): array
    {
        $result =  $this->queryBuilder->select('classes');

        $classes = [];
        while ($row = pg_fetch_assoc($result)) {
            $classes[] = $row;
        }

        return $classes;
    }

    public function create($data): Result|false
    {
        return $this->queryBuilder->insert('classes', $data);
    }

    public function update($id, $data): Result|false
    {
        return $this->queryBuilder->update('classes', $data, ['id' => $id]);
    }

    public function delete($id): Result|false
    {
        return $this->queryBuilder->delete('classes', ['id' => $id]);
    }
}