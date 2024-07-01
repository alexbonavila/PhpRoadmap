<?php

namespace App\Repository;

use MongoDB\Client as MongoClient;

class PostRepository extends BaseRepository {

    public function __construct(MongoClient $client) {
        parent::__construct($client->selectCollection('my_database', 'posts'));
    }

    public function findByUserId(string $userId): array
    {
        return $this->collection->find(['userId' => $userId])->toArray();
    }
}
