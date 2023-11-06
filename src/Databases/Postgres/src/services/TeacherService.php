<?php

class TeacherService {
    private Teacher $teacher;

    public function __construct($connection) {
        $this->teacher = new Teacher($connection);
    }

    public function create($data) {
        if (empty($data['dni']) || empty($data['name'])) {
            throw new InvalidArgumentException('DNI and name are mandatory.');
        }
        return $this->teacher->create($data);
    }

    public function getAll() {
        return $this->teacher->all();
    }

    public function findByDni($dni) {
        if (empty($dni)) {
            throw new InvalidArgumentException('DNI is mandatory.');
        }
        return $this->teacher->find($dni);
    }

    public function update($id, $data) {
        if (empty($id) || !is_numeric($id)) {
            throw new InvalidArgumentException('DNI is mandatory and it must be numeric.');
        }
        return $this->teacher->update($id, $data);
    }

    public function delete($id) {
        if (empty($id) || !is_numeric($id)) {
            throw new InvalidArgumentException('DNI is mandatory and it must be numeric.');
        }
        return $this->teacher->delete($id);
    }
}
