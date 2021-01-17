<?php


namespace App\Src\Models\Hyper\Pagination;

use Carbon\Carbon;

class PaginationEmployeeScheduleModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $api_token;

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
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return PaginationEmployeeScheduleModel
     */
    public function setId(int $id): PaginationEmployeeScheduleModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiToken(): string
    {
        return $this->api_token;
    }

    /**
     * @param string $api_token
     * @return PaginationEmployeeScheduleModel
     */
    public function setApiToken(string $api_token): PaginationEmployeeScheduleModel
    {
        $this->api_token = $api_token;
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
     * @return PaginationEmployeeScheduleModel
     */
    public function setStartDate(Carbon $start_date): PaginationEmployeeScheduleModel
    {
        $this->start_date = $start_date;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getEndDate(): Carbon
    {
        return $this->end_date;
    }

    /**
     * @param Carbon $end_date
     * @return PaginationEmployeeScheduleModel
     */
    public function setEndDate(Carbon $end_date): PaginationEmployeeScheduleModel
    {
        $this->end_date = $end_date;
        return $this;
    }
}
