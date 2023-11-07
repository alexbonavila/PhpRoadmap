<?php

/**
 * Class Create handles the insertion of data into Database tables.
 */
class Create {
    /**
     * @var PDO Instance of PDO for Database interaction.
     */
    private PDO $pdo;

    /**
     * Constructor initializes the Create Class with a PDO object.
     *
     * @param PDO $pdo A PDO instance for Database interaction.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Inserts data into a specified table.
     *
     * Prepares an SQL statement to insert data into a specified table
     * and binds the data to the statement before executing it.
     * Returns the last insert ID on success or false on failure.
     *
     * @param string $table The name of the table to insert data into.
     * @param array $data Associative array of data to be inserted (column => value).
     * @return false|string The last insert ID on success or false on failure.
     */
    public function insertData(string $table, array $data): false|string
    {
        // Prepare SQL statement based on table and data keys
        $keys = array_keys($data);
        $fields = implode(', ', $keys);
        $placeholders = ':' . implode(', :', $keys);

        $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($sql);

        // Bind data values to placeholders
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // Execute the statement
        try {
            $stmt->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            echo "Insertion error: " . $e->getMessage();
            return false;
        }
    }
}
