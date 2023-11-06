<?php

namespace Postgres\Src\Services;

use InvalidArgumentException;
use PgSql\Result;
use Postgres\Src\Models\ClassModel;

class ClassService {
    private ClassModel $classModel;

    public function __construct($connection) {
        $this->classModel = new ClassModel($connection);
    }

    public function create($data): Result|false
    {
        if (empty($data['code']) || empty($data['name'])) {
            throw new InvalidArgumentException('The code and name are required.');
        }
        return $this->classModel->create($data);
    }

    public function getAll(): array
    {
        return $this->classModel->all();
    }

    public function findById($id): false|array
    {
        if (empty($id)) {
            throw new InvalidArgumentException('The code is mandatory.');
        }
        return $this->classModel->find($id);
    }

    public function update($id, $data): Result|false
    {
        if (empty($id) || !is_numeric($id)) {
            throw new InvalidArgumentException('The ID is required and must be numeric.');
        }
        return $this->classModel->update($id, $data);
    }

    public function delete($id): Result|false
    {
        if (empty($id) || !is_numeric($id)) {
            throw new InvalidArgumentException('The ID is required and must be numeric.');
        }
        return $this->classModel->delete($id);
    }
}
