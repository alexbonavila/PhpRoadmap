<?php

namespace App\Model;

use MongoDB\Collection;

class Post {
    private Collection $collection;

    public function __construct(Collection $collection) {
        $this->collection = $collection;
    }

    public function create(array $postData): bool {
        $insertOneResult = $this->collection->insertOne($postData);
        return $insertOneResult->isAcknowledged();
    }

    public function read(string $postId): ?object {
        return $this->collection->findOne(['_id' => $postId]);
    }

    public function update(string $postId, array $newData): int {
        $updateResult = $this->collection->updateOne(['_id' => $postId], ['$set' => $newData]);
        return $updateResult->getModifiedCount();
    }

    public function delete(string $postId): int {
        $deleteResult = $this->collection->deleteOne(['_id' => $postId]);
        return $deleteResult->getDeletedCount();
    }
}

