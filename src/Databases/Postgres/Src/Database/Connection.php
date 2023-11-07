<?php

namespace Postgres\Src\Database;

/**
 * The Connection class manages a connection to a PostgreSQL database.
 */
class Connection {
    /**
     * Holds the single instance of the database connection.
     *
     * @var \PgSql\Connection|null
     */
    private static ?\PgSql\Connection $connection = null;

    /**
     * Returns the single instance of the database connection.
     *
     * If the connection does not exist, it attempts to create one using the pg_connect function.
     * It uses environment variables to retrieve connection parameters.
     *
     * @return \PgSql\Connection|null The database connection instance.
     */
    public static function getConnection(): ?\PgSql\Connection
    {
        // Check if the connection already exists
        if (!self::$connection) {
            // Attempt to establish a new connection if it doesn't exist
            self::$connection = pg_connect(
                "host=" . getenv('DB_HOST') .
                " port=" . getenv('DB_PORT') .
                " dbname=" . getenv('DB_DATABASE') .
                " user=" . getenv('DB_USERNAME') .
                " password=" . getenv('DB_PASSWORD')
            ) or die('Cannot establish connection: ' . pg_last_error());
        }

        // Return the existing or new connection
        return self::$connection;
    }
}
