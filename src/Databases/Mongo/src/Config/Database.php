<?php

namespace App\Config;

use MongoDB\Client;

class Database
{
    private static Client $client;

    public static function initialize(): void
    {
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $dbName = $_ENV['DB_DATABASE'];

        $uri = "mongodb://$host:$port/$dbName?authSource=admin";
        echo $uri;
        $options = [];

        if ($username && $password) {
            $options = [
                'username' => $username,
                'password' => $password
            ];
        }

        self::$client = new Client($uri, $options);
    }

    public static function getClient(): Client
    {
        return self::$client;
    }
}