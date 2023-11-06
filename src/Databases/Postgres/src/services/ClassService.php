<?php

class ClassService {
    private ClassModel $classModel;

    public function __construct($connection) {
        $this->classModel = new ClassModel($connection);
    }

    public function create($data) {
        if (empty($data['code']) || empty($data['name'])) {
            throw new InvalidArgumentException('The code and name are required.');
        }
        return $this->classModel->create($data);
    }

    public function getAll() {
        return $this->classModel->all();
    }

    public function findByCode($code) {
        if (empty($code)) {
            throw new InvalidArgumentException('The code is mandatory.');
        }
        return $this->classModel->find($code);
    }

    public function update($id, $data) {
        if (empty($id) || !is_numeric($id)) {
            throw new InvalidArgumentException('The ID is required and must be numeric.');
        }
        return $this->classModel->update($id, $data);
    }

    public function delete($id) {
        if (empty($id) || !is_numeric($id)) {
            throw new InvalidArgumentException('The ID is required and must be numeric.');
        }
        return $this->classModel->delete($id);
    }
}
