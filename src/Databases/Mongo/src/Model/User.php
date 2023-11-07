<?php

namespace App\Model;

use MongoDB\Collection;

class User {
    private Collection $collection;

    public function __construct(Collection $collection) {
        $this->collection = $collection;
    }

    public function create(array $userData): bool {
        $insertOneResult = $this->collection->insertOne($userData);
        return $insertOneResult->isAcknowledged();
    }

    public function read(string $userId): ?object {
        return $this->collection->findOne(['_id' => $userId]);
    }

    public function readByDni(string $dni): ?object {
        return $this->collection->findOne(['dni' => $dni]);
    }

    public function update(string $dni, array $newData): int {
        $updateResult = $this->collection->updateOne(['dni' => $dni], ['$set' => $newData]);
        return $updateResult->getModifiedCount();
    }

    public function delete(string $dni): int {
        $deleteResult = $this->collection->deleteOne(['dni' => $dni]);
        return $deleteResult->getDeletedCount();
    }
}
