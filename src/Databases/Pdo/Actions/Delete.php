<?php

class Delete {
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function deleteById($table, $id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$table} WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->rowCount(); // Number of rows affected
        } catch (PDOException $e) {
            echo "Deletion error: " . $e->getMessage();
            return false;
        }
    }
}
