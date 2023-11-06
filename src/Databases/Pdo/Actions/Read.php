<?php

/**
 * Class Read handles the retrieval of data from Database tables.
 */
class Read {
    /**
     * @var PDO Instance of PDO for Database interaction.
     */
    private PDO $pdo;

    /**
     * Constructor initializes the Read class with a PDO object.
     *
     * @param PDO $pdo A PDO instance for Database interaction.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Retrieves all records from a specified table.
     *
     * Executes a SELECT statement to fetch all rows from a specified table
     * and returns the result as an associative array.
     *
     * @param string $table The name of the table to retrieve data from.
     * @return array|false An array of fetched rows or false on failure.
     */
    public function getAll(string $table): false|array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $table");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves a record from a specified table by its ID.
     *
     * Prepares a SELECT statement to fetch a row from a specified table
     * by its ID and returns the result as an associative array.
     *
     * @param string $table The name of the table to retrieve data from.
     * @param int $id The ID of the record to retrieve.
     * @return mixed An associative array of the fetched row or false on failure.
     */
    public function getById(string $table, int $id): mixed
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves a record from a specified table by a specific field and value.
     *
     * Prepares a SELECT statement to fetch a row from a specified table
     * by a specific field and value and returns the result as an associative array.
     *
     * @param string $table The name of the table to retrieve data from.
     * @param string $field The field to filter by.
     * @param mixed $value The value of the field to filter by.
     * @return mixed An associative array of the fetched row or false on failure.
     */
    public function getByField(string $table, string $field, mixed $value): mixed
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE $field = :$field");
        $stmt->bindParam(":$field", $value);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
