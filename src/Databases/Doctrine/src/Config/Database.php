<?php

namespace App\Config;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Database
{
    private static EntityManager $client;

    public static function initialize(): void
    {
        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;


        $conn = array(
            'driver'   => $_ENV['DB_DRIVER'],
            'user'     => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'dbname'   => $_ENV['DB_DATABASE'],
        );

        self::$client = EntityManager::create($conn, $config);
    }

    public static function getClient(): EntityManager
    {
        return self::$client;
    }
}