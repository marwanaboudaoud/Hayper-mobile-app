<?php


namespace App\Src\Models\Hyper\Availability;

use Carbon\Carbon;

class AvailabilityModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Carbon
     */
    private $date;

    /**
     * @var boolean
     */
    private $present;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $apiToken;

    /**
     * @var int
     */
    private $availabilityShiftId;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return AvailabilityModel
     */
    public function setId(?int $id): AvailabilityModel
    {
        $this->id = $id;
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
     * @return AvailabilityModel
     */
    public function setDate(?Carbon $date): AvailabilityModel
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPresent(): ?bool
    {
        return $this->present;
    }

    /**
     * @param bool $present
     * @return AvailabilityModel
     */
    public function setPresent(?bool $present): AvailabilityModel
    {
        $this->present = $present;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return AvailabilityModel
     */
    public function setUserId(?int $userId): AvailabilityModel
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiToken(): ?string
    {
        return $this->apiToken;
    }

    /**
     * @param string $apiToken
     * @return AvailabilityModel
     */
    public function setApiToken(?string $apiToken): AvailabilityModel
    {
        $this->apiToken = $apiToken;

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
     * @return AvailabilityModel
     */
    public function setAvailabilityShiftId(?int $availabilityShiftId): AvailabilityModel
    {
        $this->availabilityShiftId = $availabilityShiftId;
        return $this;
    }
}
