<?php


namespace App\Src\Models\Hyper\Availability;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class AvailabilityCountModel
{
    /**
     * @var Carbon
     */
    private $date;

    /**
     * @var Collection
     */
    private $employees = [];

    /**
     * @var boolean
     */
    private $present;

    /**
     * @var boolean
     */
    private $driver;

    /**
     * @var Collection
     */
    private $availabilityShiftIds;

    /**
     * @return Carbon
     */
    public function getDate(): ?Carbon
    {
        return $this->date;
    }

    /**
     * @param Carbon $date
     * @return AvailabilityCountModel
     */
    public function setDate(?Carbon $date): AvailabilityCountModel
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
     * @return AvailabilityCountModel
     */
    public function setEmployees(?Collection $employees): AvailabilityCountModel
    {
        $this->employees = $employees;
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
     * @return AvailabilityCountModel
     */
    public function setPresent(?bool $present): AvailabilityCountModel
    {
        $this->present = $present;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDriver(): ?bool
    {
        return $this->driver;
    }

    /**
     * @param bool $driver
     * @return AvailabilityCountModel
     */
    public function setDriver(?bool $driver): AvailabilityCountModel
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getAvailabilityShiftIds(): Collection
    {
        return $this->availabilityShiftIds;
    }

    /**
     * @param Collection $availabilityShiftIds
     * @return AvailabilityCountModel
     */
    public function setAvailabilityShiftIds(?Collection $availabilityShiftIds): AvailabilityCountModel
    {
        $this->availabilityShiftIds = $availabilityShiftIds;

        return $this;
    }

    public function addAvailabilityShiftId(int $id): AvailabilityCountModel
    {
        $this->getAvailabilityShiftIds()->add($id);

        return $this;
    }
}
