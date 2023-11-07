<?php

namespace App\Model;

use MongoDB\Collection;

class Comment {
    private Collection $collection;

    public function __construct(Collection $collection) {
        $this->collection = $collection;
    }

    public function create(array $commentData): bool {
        $insertOneResult = $this->collection->insertOne($commentData);
        return $insertOneResult->isAcknowledged();
    }

    public function read(string $commentId): ?object {
        return $this->collection->findOne(['_id' => $commentId]);
    }

    public function update(string $commentId, array $newData): int {
        $updateResult = $this->collection->updateOne(['_id' => $commentId], ['$set' => $newData]);
        return $updateResult->getModifiedCount();
    }

    public function delete(string $commentId): int {
        $deleteResult = $this->collection->deleteOne(['_id' => $commentId]);
        return $deleteResult->getDeletedCount();
    }
}
