<?php

/**
 * Setup class responsible for initializing database tables.
 */
class Setup
{
    /**
     * @var PDO Instance of PDO for database interaction.
     */
    private $pdo;
    /**
     * @var string[] Array containing SQL statements to create tables.
     */
    private $tables = [
        'User' => "CREATE TABLE IF NOT EXISTS User (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE
        )",
        'Document' => "CREATE TABLE IF NOT EXISTS Document (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            dni TEXT NOT NULL UNIQUE,
            user_id INTEGER NOT NULL,
            FOREIGN KEY(user_id) REFERENCES User(id) ON DELETE CASCADE
        )",
        'Post' => "CREATE TABLE IF NOT EXISTS Post (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            text TEXT NOT NULL,
            user_id INTEGER NOT NULL,
            FOREIGN KEY(user_id) REFERENCES User(id) ON DELETE CASCADE
        )"
    ];

    /**
     * Constructor establishes a PDO connection and sets the error mode.
     */
    public function __construct()
    {
        $this->pdo = new PDO('sqlite:./DB.sqlite');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Executes an SQL statement using the PDO instance.
     *
     * @param $sql
     * @return void
     */
    private function executeStatement($sql)
    {
        $this->pdo->exec($sql);
    }

    /**
     * Drops existing tables based on the table names defined in $tables.
     *
     * @return void
     */
    private function dropTables()
    {
        foreach ($this->tables as $tableName => $sql) {
            $this->executeStatement("DROP TABLE IF EXISTS {$tableName}");
        }
    }

    /**
     * Creates new tables based on the SQL statements defined in $tables.
     *
     * @return void
     */
    private function createTables()
    {
        foreach ($this->tables as $sql) {
            $this->executeStatement($sql);
        }
    }

    /**
     * Main method that orchestrates the dropping and creation of tables.
     * Returns the PDO instance on success or NULL on failure.
     *
     * @return PDO|NULL The PDO instance if successful, NULL otherwise.
     */
    public function index()
    {
        try {
            $this->dropTables();
            $this->createTables();

            echo "All tables created." . PHP_EOL;
            return $this->pdo;
        } catch (PDOException $e) {
            echo "Error connection or during table creation: " . $e->getMessage() . PHP_EOL;
            return NULL;
        }
    }
}
