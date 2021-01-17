<?php


namespace App\Src\Models\Hyper\Partner;

use App\Src\Models\Hyper\Pagination\PaginationModel;
use App\Src\Models\Hyper\Project\ProjectModel;

class PartnerModel
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
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $house_number;

    /**
     * @var string
     */
    private $postcode;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var ProjectModel
     */
    private $project;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return PartnerModel
     */
    public function setId(?int $id): PartnerModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return PartnerModel
     */
    public function setName(?string $name): PartnerModel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return PartnerModel
     */
    public function setAddress(?string $address): PartnerModel
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getHouseNumber(): ?string
    {
        return $this->house_number;
    }

    /**
     * @param string $house_number
     * @return PartnerModel
     */
    public function setHouseNumber(?string $house_number): PartnerModel
    {
        $this->house_number = $house_number;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * @param string $postcode
     * @return PartnerModel
     */
    public function setPostcode(?string $postcode): PartnerModel
    {
        $this->postcode = $postcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return PartnerModel
     */
    public function setCity(?string $city): PartnerModel
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return PartnerModel
     */
    public function setPhone(?string $phone): PartnerModel
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return ProjectModel
     */
    public function getProject(): ?ProjectModel
    {
        return $this->project;
    }

    /**
     * @param ProjectModel $project
     * @return PartnerModel
     */
    public function setProject(?ProjectModel $project): ?PartnerModel
    {
        $this->project = $project;
        return $this;
    }
}
