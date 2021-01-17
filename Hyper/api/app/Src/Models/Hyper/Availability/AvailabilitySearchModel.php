<?php


namespace App\Src\Models\Hyper\Availability;

use App\Src\Models\Hyper\User\UserModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class AvailabilitySearchModel
{
    /**
     * @var Carbon
     */
    private $date;

    /**
     * @var bool
     */
    private $driver;

    /**
     * @var UserModel
     */
    private $employee;

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
     * @return AvailabilitySearchModel
     */
    public function setDate(?Carbon $date): AvailabilitySearchModel
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @param UserModel $userModel
     * @return $this
     */
    public function setEmployee(UserModel $userModel)
    {
        $this->employee = $userModel;

        return $this;
    }

    /**
     * @return UserModel
     */
    public function getEmployee()
    {
        return $this->employee;
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
     * @return AvailabilitySearchModel
     */
    public function setDriver(?bool $driver): AvailabilitySearchModel
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
     * @return AvailabilitySearchModel
     */
    public function setAvailabilityShiftIds(?Collection $availabilityShiftIds): AvailabilitySearchModel
    {
        $this->availabilityShiftIds = $availabilityShiftIds;

        return $this;
    }

    public function addAvailabilityShiftId(int $id): AvailabilitySearchModel
    {
        $this->getAvailabilityShiftIds()->add($id);

        return $this;
    }
}
