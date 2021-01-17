<?php


namespace App\Src\Models\Hyper\Gender;

class GenderModel
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
     * @return GenderModel
     */
    public function setId(int $id): GenderModel
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
     * @return GenderModel
     */
    public function setName(string $name): GenderModel
    {
        $this->name = $name;
        return $this;
    }
}
