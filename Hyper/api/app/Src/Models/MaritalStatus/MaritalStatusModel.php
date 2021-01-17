<?php


namespace App\Src\Models\MaritalStatus;

class MaritalStatusModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return MaritalStatusModel
     */
    public function setId(int $id): MaritalStatusModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return MaritalStatusModel
     */
    public function setName(string $name): MaritalStatusModel
    {
        $this->name = $name;
        return $this;
    }
}
