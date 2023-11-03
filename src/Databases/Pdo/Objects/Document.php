<?php

/**
 * Document Object
 */
class Document{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $dni;
    /**
     * @var int
     */
    private int $user_id;

    /**
     * @param int $id
     * @param string $dni
     * @param int $user_id
     */
    public function __construct(int $id, string $dni, int $user_id)
    {
        $this->id = $id;
        $this->dni = $dni;
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDni(): string
    {
        return $this->dni;
    }

    /**
     * @param string $dni
     * @return void
     */
    public function setDni(string $dni): void
    {
        $this->dni = $dni;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     * @return void
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }
}