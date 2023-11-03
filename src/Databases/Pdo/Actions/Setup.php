<?php

class Setup
{

    public function __construct()
    {
    }

    public function index()
    {
        try {
            // Establishing SQLite database connection
            $pdo = new PDO('sqlite:../database.sqlite');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Drop tables
            $pdo->exec("DROP TABLE IF EXISTS Post");
            $pdo->exec("DROP TABLE IF EXISTS Document");
            $pdo->exec("DROP TABLE IF EXISTS User");

            // User table created
            $pdo->exec("CREATE TABLE IF NOT EXISTS User (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE
    )");

            // Document table created
            $pdo->exec("CREATE TABLE IF NOT EXISTS Document (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        dni TEXT NOT NULL UNIQUE,
        user_id INTEGER NOT NULL,
        FOREIGN KEY(user_id) REFERENCES User(id) ON DELETE CASCADE
    )");

            // Post table created
            $pdo->exec("CREATE TABLE IF NOT EXISTS Post (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        text TEXT NOT NULL,
        user_id INTEGER NOT NULL,
        FOREIGN KEY(user_id) REFERENCES User(id) ON DELETE CASCADE
    )");

            echo "All tables created.". PHP_EOL;

            return $pdo;

        } catch (PDOException $e) {
            echo "Error connection or during table creation: " . $e->getMessage(). PHP_EOL;

            return "ERROR";
        }
    }
}