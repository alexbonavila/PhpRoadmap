<?php

namespace App\Repository;

use MongoDB\Client as MongoClient;

class UserRepository extends BaseRepository {

    public function __construct(MongoClient $client) {
        parent::__construct($client->selectCollection('my_database', 'users'));
    }

    public function findByEmail(string $email): ?object
    {
        return $this->collection->findOne(['email' => $email]);
    }
}
