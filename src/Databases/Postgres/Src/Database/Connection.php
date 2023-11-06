<?php

namespace Postgres\Src\Database;

class Connection {
    private static $connection;

    public static function getConnection() {
        if (!self::$connection) {
            self::$connection = pg_connect(
                "host=" . getenv('DB_HOST') .
                " port=" . getenv('DB_PORT') .
                " dbname=" . getenv('DB_DATABASE') .
                " user=" . getenv('DB_USERNAME') .
                " password=" . getenv('DB_PASSWORD')
            ) or die('No se ha podido conectar: ' . pg_last_error());
        }

        return self::$connection;
    }
}