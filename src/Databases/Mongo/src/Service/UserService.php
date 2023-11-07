<?php

namespace App\Service;

use App\Repository\UserRepository;

class UserService {
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $userData): bool {
        if ($this->userRepository->getUserByDni($userData['dni'])) {
            throw new \Exception("DNI already in database.");
        }

        if (!preg_match("/^[a-zA-Z ]*$/", $userData['name'])) {
            throw new \Exception("Not allowed characters in user name.");
        }

        return $this->userRepository->createUser($userData);
    }

    public function getUser(string $dni): ?object {
        return $this->userRepository->getUserByDni($dni);
    }

    public function updateUser(string $dni, array $userData): bool {
        return $this->userRepository->updateUser($dni, $userData) > 0;
    }

    public function deleteUser(string $dni): bool {
        return $this->userRepository->deleteUser($dni) > 0;
    }
}
