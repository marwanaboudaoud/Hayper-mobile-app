<?php


namespace App\Src\Models\Hyper\Availability;

use Carbon\Carbon;

class MyAvailabilityModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Carbon
     */
    private $start_date;

    /**
     * @var Carbon
     */
    private $end_date;

    /**
     * @return int
     */

    /**
     * @var string
     */
    private $token;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return MyAvailabilityModel
     */
    public function setId(?int $id): MyAvailabilityModel
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
     * @return MyAvailabilityModel
     */
    public function setDate(?Carbon $date): MyAvailabilityModel
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return MyAvailabilityModel
     */
    public function setToken(?string $token): MyAvailabilityModel
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getStartDate(): Carbon
    {
        return $this->start_date;
    }

    /**
     * @param Carbon $start_date
     * @return MyAvailabilityModel
     */
    public function setStartDate(Carbon $start_date): MyAvailabilityModel
    {
        $this->start_date = $start_date;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getEndDate(): ?Carbon
    {
        return $this->end_date;
    }

    /**
     * @param Carbon $end_date
     * @return MyAvailabilityModel
     */
    public function setEndDate(?Carbon $end_date): MyAvailabilityModel
    {
        $this->end_date = $end_date;
        return $this;
    }
}
