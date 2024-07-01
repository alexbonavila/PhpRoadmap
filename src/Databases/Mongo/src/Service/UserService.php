<?php

namespace App\Service;

use App\Model\User;
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
    public function createUser(User $user): object
    {
        // Validating data
        if (!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email');
        }

        $result = $this->userRepository->create($user->toArray());

        $user->mapObject($this->userRepository->readById($result->getInsertedId()));

        return $user;
    }

    public function getUserByEmail(string $email): ?object {
        $user = new User();
        $user->mapObject($this->userRepository->findByEmail($email));
        return $user;
    }

    public function updateUser(string $userId, array $newData): int {
        $newData['updatedAt'] = new UTCDateTime();
        return $this->userRepository->update($userId, $newData);
    }

    public function deleteUser(string $userId): int {
        return $this->userRepository->delete($userId);
    }

    public function getAllUsers(): array {
        $users = [];
        $users_raw = $this->userRepository->readAll();

        foreach ($users_raw as $rUser) {
            $user = new User();
            $user->mapObject($rUser);
            $users[] = $user;
        }

        return $users;
    }
}
