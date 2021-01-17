<?php


namespace App\Src\Models\Hyper\Schedule;

use App\Src\Models\Hyper\Partner\PartnerModel;
use App\Src\Models\Hyper\Project\ProjectModel;
use App\Src\Models\Hyper\User\UserModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ScheduleModel
{
    /**
     * @var integer
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
    private $postcode;

    /**
     * @var string
     */
    private $city;

    /**
     * @var Carbon
     */
    private $date;

    /**
     * @var Collection
     */
    private $employees;

    /**
     * @var UserModel
     */
    private $driver;

    /**
     * @var int
     */
    private $projectId;

    /**
     * @var PartnerModel
     */
    private $partner;

    /**
     * @var int
     */
    private $availabilityShiftId;

    /**
     * @var Collection
     */
    private $availabilityShiftIds;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ScheduleModel
     */
    public function setId(?int $id): ScheduleModel
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
     * @return ScheduleModel
     */
    public function setName(?string $name): ScheduleModel
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
     * @return ScheduleModel
     */
    public function setAddress(?string $address): ScheduleModel
    {
        $this->address = $address;
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
     * @return ScheduleModel
     */
    public function setPostcode(?string $postcode): ScheduleModel
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
     * @return ScheduleModel
     */
    public function setCity(?string $city): ScheduleModel
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getDate(): ?Carbon
    {
        return $this->date;
    }

    /**
     * @param Carbon $date
     * @return ScheduleModel
     */
    public function setDate(?Carbon $date): ScheduleModel
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getEmployees(): ?Collection
    {
        return $this->employees;
    }

    /**
     * @param Collection $employees
     * @return ScheduleModel
     */
    public function setEmployees(?Collection $employees): ScheduleModel
    {
        $this->employees = $employees;

        return $this;
    }

    /**
     * @return UserModel
     */
    public function getDriver(): ?UserModel
    {
        return $this->driver;
    }

    /**
     * @param UserModel $driver
     * @return ScheduleModel
     */
    public function setDriver(?UserModel $driver): ScheduleModel
    {
        $this->driver = $driver;
        return $this;
    }

    /**
     *
     */
    public function getProjectId(): ?int
    {
        return $this->projectId;
    }

    /**
     * @param int $projectId
     * @return ScheduleModel
     */
    public function setProjectId(?int $projectId): ScheduleModel
    {
        $this->projectId = $projectId;

        return $this;
    }

    /**
     * @return PartnerModel
     */
    public function getPartner(): ?PartnerModel
    {
        return $this->partner;
    }

    /**
     * @param PartnerModel $partner
     * @return ScheduleModel
     */
    public function setPartner(?PartnerModel $partner): ScheduleModel
    {
        $this->partner = $partner;
        return $this;
    }

    /**
     * @return int
     */
    public function getAvailabilityShiftId(): ?int
    {
        return $this->availabilityShiftId;
    }

    /**
     * @param int $availabilityShiftId
     * @return ScheduleModel
     */
    public function setAvailabilityShiftId(?int $availabilityShiftId): ScheduleModel
    {
        $this->availabilityShiftId = $availabilityShiftId;

        return $this;
    }
}
