<?php


namespace App\Src\Models\Hyper\Country;

class CountryModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $country;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return CountryModel
     */
    public function setId(int $id): CountryModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return CountryModel
     */
    public function setCountry(string $country): CountryModel
    {
        $this->country = $country;
        return $this;
    }
}
