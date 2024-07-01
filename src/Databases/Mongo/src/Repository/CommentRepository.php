<?php

namespace App\Repository;

use MongoDB\Client as MongoClient;

class CommentRepository extends BaseRepository {

    public function __construct(MongoClient $client) {
        parent::__construct($client->selectCollection('my_database', 'comments'));
    }

    public function findByPostId(string $postId): array
    {
        return $this->collection->find(['postId' => $postId])->toArray();
    }

}
