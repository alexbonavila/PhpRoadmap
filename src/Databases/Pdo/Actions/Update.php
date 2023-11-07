<?php

/**
 * Class Update handles the updating of records in Database tables.
 */
class Update {
    /**
     * @var PDO Instance of PDO for Database interaction.
     */
    private PDO $pdo;

    /**
     * Constructor initializes the Update Class with a PDO object.
     *
     * @param PDO $pdo A PDO instance for Database interaction.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Updates a record in a specified table by its ID.
     *
     * Prepares an SQL statement to update specific fields of a record
     * in a specified table by its ID. Returns the number of rows affected
     * on success or false on failure.
     *
     * @param string $table The name of the table to update the record in.
     * @param int $id The ID of the record to update.
     * @param array $data Associative array of data to be updated (column => value).
     * @return int|false The number of rows affected or false on failure.
     */
    public function updateById(string $table, int $id, array $data): false|int
    {
        // Prepare the SQL statement
        $setPart = [];
        foreach ($data as $key => $value) {
            $setPart[] = "{$key} = :{$key}";
        }
        $setPartString = implode(', ', $setPart);

        $sql = "UPDATE {$table} SET {$setPartString} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        // Bind the ID and data values to the prepared statement
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        // Execute the statement
        try {
            $stmt->execute();
            return $stmt->rowCount(); // Number of rows affected
        } catch (PDOException $e) {
            echo "Update error: " . $e->getMessage();
            return false;
        }
    }
}
