<?php


namespace App\Src\Models\Hyper\Address;

class AddressModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $house_number;

    /**
     * @var string
     */
    private $addition;

    /**
     * @var string
     */
    private $postcode;

    /**
     * @var string
     */
    private $city;

    /**
     * @var int
     */
    private $user;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param  int $id
     * @return AddressModel
     */
    public function setId(?int $id): AddressModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param  string $street
     * @return AddressModel
     */
    public function setStreet(?string $street): AddressModel
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getHouseNumber(): ?int
    {
        return $this->house_number;
    }

    /**
     * @param  int|null $house_number
     * @return AddressModel
     */
    public function setHouseNumber(?int $house_number): AddressModel
    {
        $this->house_number = $house_number;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddition(): ?string
    {
        return $this->addition;
    }

    /**
     * @param  string $addition
     * @return AddressModel
     */
    public function setAddition(?string $addition): AddressModel
    {
        $this->addition = $addition;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @param  string $postcode
     * @return AddressModel
     */
    public function setPostcode(?string $postcode): AddressModel
    {
        $this->postcode = $postcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param  string $city
     * @return AddressModel
     */
    public function setCity(?string $city): AddressModel
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return int
     */
    public function getUser(): ?int
    {
        return $this->user;
    }

    /**
     * @param  int $user
     * @return AddressModel
     */
    public function setUser(?int $user): AddressModel
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param  bool $active
     * @return AddressModel
     */
    public function setActive(?bool $active): AddressModel
    {
        $this->active = $active;
        return $this;
    }
}
