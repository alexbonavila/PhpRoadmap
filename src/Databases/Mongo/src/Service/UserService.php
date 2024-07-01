<?php

namespace App\Service;

use App\Repository\UserRepository;
use Exception;
use MongoDB\BSON\UTCDateTime;

class UserService {
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws Exception
     */
    public function createUser(array $userData): bool {
        // Validating data
        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email');
        }
        $result = $this->userRepository->create($userData);

        return $result->isAcknowledged();
    }

    public function getUserByEmail(string $email): ?object {
        return $this->userRepository->findByEmail($email);
    }

    public function updateUser(string $userId, array $newData): int {
        $newData['updatedAt'] = new UTCDateTime();
        return $this->userRepository->update($userId, $newData);
    }

    public function deleteUser(string $userId): int {
        return $this->userRepository->delete($userId);
    }

    public function getAllUsers(): array {
        return $this->userRepository->readAll();
    }
}
