<?php


namespace App\Src\Models\Hyper\Nationality;

class NationalityModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $nationality_code;

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
     * @return NationalityModel
     */
    public function setId(int $id): NationalityModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getNationalityCode(): int
    {
        return $this->nationality_code;
    }

    /**
     * @param int $nationality_code
     * @return NationalityModel
     */
    public function setNationalityCode(int $nationality_code): NationalityModel
    {
        $this->nationality_code = $nationality_code;
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
     * @return NationalityModel
     */
    public function setName(string $name): NationalityModel
    {
        $this->name = $name;
        return $this;
    }
}
