<?php

namespace App\Repository;

use MongoDB\BSON\ObjectId;
use MongoDB\Collection;
use MongoDB\InsertOneResult;

class BaseRepository
{
    protected Collection $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function create(array $objectData): InsertOneResult
    {
        return $this->collection->insertOne($objectData);
    }

    public function readAll(): array
    {
        return $this->collection->find()->toArray();
    }

    public function readById(string $objectId): ?object
    {
        return $this->collection->findOne(['_id' => new ObjectId($objectId)]);
    }

    public function readByIds(array $objectIds): array
    {
        $ids = array_map(function($id) {
            return new ObjectId($id);
        }, $objectIds);

        return $this->collection->find(['_id' => ['$in' => $ids]])->toArray();
    }

    public function update(string $objectId, array $newData): int
    {
        $updateResult = $this->collection->updateOne(['_id' => new ObjectId($objectId)], ['$set' => $newData]);
        return $updateResult->getModifiedCount();
    }

    public function delete(string $objectId): int
    {
        $deleteResult = $this->collection->deleteOne(['_id' => new ObjectId($objectId)]);
        return $deleteResult->getDeletedCount();
    }
}