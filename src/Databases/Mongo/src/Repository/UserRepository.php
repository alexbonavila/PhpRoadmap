<?php

namespace App\Repository;

use App\Model\User;
use MongoDB\Client as MongoClient;

class UserRepository {
    private User $userModel;

    public function __construct(MongoClient $client) {
        $this->userModel = new User($client->selectCollection('my_database', 'users'));
    }

    public function createUser(array $data): bool {
        return $this->userModel->create($data);
    }

    public function getUserById(string $id): ?object {
        return $this->userModel->read($id);
    }

    public function getUserByDni(string $dni): ?object {
        return $this->userModel->readByDni($dni);
    }

    public function updateUser(string $dni, array $newData): int {
        return $this->userModel->update($dni, $newData);
    }

    public function deleteUser(string $dni): int {
        return $this->userModel->delete($dni);
    }
}
